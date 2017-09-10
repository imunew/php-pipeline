# php-pipeline
This package provides a pipeline of `callable` functions or classes that have `__invoke()`.  
This package was inspired strongly by the [League\Pipeline](http://pipeline.thephpleague.com).

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/imunew/php-pipeline/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/imunew/php-pipeline/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/imunew/php-pipeline/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/imunew/php-pipeline/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/imunew/php-pipeline/badges/build.png?b=master)](https://scrutinizer-ci.com/g/imunew/php-pipeline/build-status/master)

## Why do not use the `League\Pipeline`?
The `League\Pipeline` is provides only add to `pipeline`.  
I want to insert or replace `callable` to pipeline.   

## Basic usage

```php
$pipes = (new Pipes())
    ->add(10, function($context) {
        /** @var ContextInterface $context */
        $data = $context->getData('number', 0);         // 1) $data = 0
        return $context->setData('number', $data + 1);  // 2) $data = 1
    })
    ->add(20, function($context) {
        /** @var ContextInterface $context */
        $data = $context->getData('number', 0);         // 2) $data = 1
        return $context->setData('number', $data * 10); // 3) $data = 10
    })
;

$pipeline = new Pipeline($pipes);
$context = $pipeline->process(new Context());

echo $context->getData('number'); // 10
```

## Insert pipe
```php
$pipes = (new Pipes())
    ->add(10, function($context) {
        /** @var ContextInterface $context */
        $data = $context->getData('number', 0);         // 1) $data = 0
        return $context->setData('number', $data + 1);  // 2) $data = 1
    })
    ->add(20, function($context) {
        /** @var ContextInterface $context */
        $data = $context->getData('number', 0);         // 3) $data = 3
        return $context->setData('number', $data * 10); // 4) $data = 30
    })
;

// Insert pipe between 10 and 20.
$pipes = $pipes->add(15, function($context) {
    /** @var ContextInterface $context */
    $data = $context->getData('number', 0);            // 2) $data = 1
    return $context->setData('number', $data + 2);     // 3) $data = 3
});

$pipeline = new Pipeline($pipes);
$context = $pipeline->process(new Context());

echo $context->getData('number'); // 30
```
