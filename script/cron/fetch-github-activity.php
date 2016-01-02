<?php

require_once __DIR__ . '/../index.php';

use Github\Client;

$client = new Client();
$client->authenticate(
    $config->github->client_id,
    $config->github->client_secret,
    Client::AUTH_URL_CLIENT_ID
);

/*********************************************
 * get changelog for jacobemerick/web
 *********************************************/
$commits = $client->api('repo')->commits()->all('jacobemerick', 'web', ['sha' => 'master']);
foreach ($commits as $commit) {
    echo "Message: ", $commit['commit']['message'], PHP_EOL;
    echo "Short Message: ", 'todo', PHP_EOL;
    echo "Date: ", $commit['commit']['author']['date'], PHP_EOL;
    echo "Author: ", $commit['commit']['author']['name'], PHP_EOL;
    echo "Link: ", $commit['html_url'], PHP_EOL;
    echo PHP_EOL;
}

echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~', PHP_EOL;

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
