<?php

require_once __DIR__ . '/../index.php';

use Github\Client;

use Jacobemerick\Web\Domain\Stream\Changelog\MysqlChangelogRepository as ChangelogRepository;

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
        new DateTime($commit['commit']['author']['date']),
        $commit['commit']['author']['name'],
        $commit['html_url']
    );
}

/*********************************************
 * get activity for jacobemerick
 *********************************************/
$events = $client->api('user')->publicEvents('jacobemerick');
foreach ($events as $event) {
    if (
        $event['type'] == 'DeleteEvent' ||
        $event['type'] == 'IssueCommentEvent' ||
        $event['type'] == 'ReleaseEvent'
    ) {
        continue;
    }
    echo "Type: ", $event['type'], PHP_EOL;
    echo "Repo: ", $event['repo']['name'], PHP_EOL;
    echo "Date: ", $event['created_at'], PHP_EOL;
    if ($event['type'] == 'CreateEvent') {
        echo " Created a new ", $event['payload']['ref_type'], ", name ", $event['payload']['ref'], PHP_EOL;
    }
    if ($event['type'] == 'ForkEvent') {
        echo " Forked to ", $event['payload']['forkee']['name'], PHP_EOL;
    }
    if ($event['type'] == 'PullRequestEvent') {
        echo ' ', ucwords($event['payload']['action']), ' a pull request to ', $event['payload']['pull_request']['base']['repo']['name'], PHP_EOL;
        echo ' Message: ', $event['payload']['pull_request']['body'], PHP_EOL;
    }
    if ($event['type'] == 'PushEvent') {
        foreach ($event['payload']['commits'] as $commit) {
            echo " Commit: ", $commit['message'], PHP_EOL;
        }
    }
    echo PHP_EOL;
}
