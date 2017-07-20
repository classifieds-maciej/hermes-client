# hermes-client
Hermes client is a PHP client for [Hermes message bus](http://hermes.allegro.tech/). It is meant to reflect [Java client](https://github.com/allegro/hermes) API.

Currently this is development version so please keep in mind that everything can change.

## Install
Add to composer.json:
```json
"require": {
  "classifieds-maciej/hermes-client": "^0.2.0"
}
```
Run:
```bash
composer install
```

## Use
### Sync
```php
$sender = new GuzzleSender(new Client());
$client = new HermesClient('http://localhost:8080/topics/', $sender);

$client->publish(new HermesMessage(
  'test.group.test_topic', 
  [
    'header1_key' => 'header1_value',
    'header2_key' => 'header2_value'
  ], 
  'test body'
));
```
### Async
```php
$sender = new GuzzleSender(new Client(['http_errors' => false]));
$client = new HermesClient('http://localhost:8080/topics/', $sender);

$client->publishAsync(
    new HermesMessage(
      'test.group.test_topic', 
      [
        'header1_key' => 'header1_value',
        'header2_key' => 'header2_value'
      ], 
      'test body'
    ),
    function (HermesResponse $response) {
        print_r($response);
    },
    function (HermesException $e, HermesMessage $message) {
        print_r($e);
        print_r($message);
    }
);
```

## Contribute
Issues and pull requests are most welcome. You can contribute in certain ways:
* Make issue on github and wait for reaction.
* Make issue and pull request at the same time. Please describe solution in the issue.
* You can propose solution to open issues by commenting and/or making pull request propositions
