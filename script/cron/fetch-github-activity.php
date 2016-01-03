<?php

require_once __DIR__ . '/../index.php';

use Github\Client;

use Jacobemerick\Web\Domain\Stream\Changelog\MysqlChangelogRepository as ChangelogRepository;
use Jacobemerick\Web\Domain\Stream\Github\MysqlGithubRepository as GithubRepository;

$client = new Client();
$client->authenticate(
    $config->github->client_id,
    $config->github->client_secret,
    Client::AUTH_URL_CLIENT_ID
);

/*********************************************
 * get changelog for jacobemerick/web
 *********************************************/
$changelogRepository = new ChangelogRepository($container['db_connection_locator']);
$mostRecentChange = $changelogRepository->getChanges(1);
$mostRecentChange = current($mostRecentChange);
$mostRecentChangeDateTime = $mostRecentChange['datetime'];
$mostRecentChangeDateTime = new DateTime($mostRecentChangeDateTime);

$parameters = [
    'sha' => 'master',
    'since' => $mostRecentChangeDateTime->format('c'),
];
$commits = $client->api('repo')->commits()->all('jacobemerick', 'web', $parameters);

foreach ($commits as $commit) {
    $uniqueChangeCheck = $changelogRepository->getChangeByHash($commit['sha']);
    if ($uniqueChangeCheck !== false) {
        continue;
    }
    $changelogRepository->insertChange(
        $commit['sha'],
        $commit['commit']['message'],
        (new DateTime($commit['commit']['author']['date']))->setTimezone($container['default_timezone']),
        $commit['commit']['author']['name'],
        $commit['html_url']
    );
}

/*********************************************
 * get activity for jacobemerick
 *********************************************/
$supportedEventTypes = [
    'CreateEvent',
    'ForkEvent',
    'PullRequestEvent',
    'PushEvent',
];

$githubRepository = new GithubRepository($container['db_connection_locator']);
$mostRecentEvent = $githubRepository->getEvents(1);
$mostRecentEvent = current($mostRecentEvent);
$mostRecentEventDateTime = $mostRecentEvent['datetime'];
$mostRecentEventDateTime = new DateTime($mostRecentEventDateTime);

$events = $client->api('user')->publicEvents('jacobemerick');
foreach ($events as $event) {
    $eventDateTime = new DateTime($event['created_at']);
    if ($eventDateTime >= $mostRecentEventDateTime) {
        break;
    }

    if (!in_array($event['type'], $supportedEventTypes)) {
        continue;
    }
    $uniqueEventCheck = $githubRepository->getEventByEventId($event['id']);
    if ($uniqueEventCheck !== false) {
        continue;
    }

    $githubRepository->insertEvent(
        $event['id'],
        $event['type'],
        $eventDateTime->setTimezone($container['default_timezone']),
        $event
    );
}
