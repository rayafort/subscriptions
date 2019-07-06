# Subscriptions Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


## [v2.1.1] - 2019-06-03
- Enforce latest composer package versions

## [v2.1.0] - 2019-06-02
- Update composer deps
- Drop PHP 7.1 travis test
- Refactor migrations and artisan commands, and tweak service provider publishes functionality
- Fix wrong container binding:
  - app('rayafort.subscriptions.plan_features') => app('rayafort.subscriptions.plan_feature')
  - app('rayafort.subscriptions.plan_subscriptions') => app('rayafort.subscriptions.plan_subscription')

## [v2.0.0] - 2019-03-03
- Require PHP 7.2 & Laravel 5.8

## [v1.0.2] - 2018-12-30
- RayaFort\Subscriptions\Services\Period: adding interval received as parameter in constructor to property ->interval

## [v1.0.1] - 2018-12-22
- Update composer dependencies
- Add PHP 7.3 support to travis
- Fix MySQL / PostgreSQL json column compatibility

## [v1.0.0] - 2018-10-01
- Enforce Consistency
- Support Laravel 5.7+
- Rename package to rayafort/laravel-subscriptions

## [v0.0.4] - 2018-09-21
- Update travis php versions
- Define polymorphic relationship parameters explicitly
- Fix fully qualified booking unit methods (fix #20)
- Convert timestamps into datetime fields and add timezone
- Tweak validation rules
- Drop StyleCI multi-language support (paid feature now!)
- Update composer dependencies
- Prepare and tweak testing configuration
- Update StyleCI options
- Update PHPUnit options
- Rename subscription model activation and deactivation methods

## [v0.0.3] - 2018-02-18
- Add PublishCommand to artisan
- Move slug auto generation to the custom HasSlug trait
- Add Rollback Console Command
- Add missing composer dependencies
- Remove useless scopes
- Add PHPUnitPrettyResultPrinter
- Use Carbon global helper
- Update composer dependencies
- Update supplementary files
- Use ->getKey() method instead of ->id
- Typehint method returns
- Drop useless model contracts (models already swappable through IoC)
- Add Laravel v5.6 support
- Simplify IoC binding
- Add force option to artisan commands
- Refactor user_id to a polymorphic relation
- Rename PlanSubscriber trait to HasSubscriptions
- Rename polymorphic relation customer to user
- Rename polymorphic relation customer to user
- Convert interval column data type into string from character

## [v0.0.2] - 2017-09-08
- Fix many issues and apply many enhancements
- Rename package rayafort/laravel-subscriptions from rayafort/subscribable

## v0.0.1 - 2017-06-29
- Tag first release

[v2.1.1]: https://github.com/rayafort/laravel-subscriptions/compare/v2.1.0...v2.1.1
[v2.1.0]: https://github.com/rayafort/laravel-subscriptions/compare/v2.0.0...v2.1.0
[v2.0.0]: https://github.com/rayafort/laravel-subscriptions/compare/v1.0.2...v2.0.0
[v1.0.2]: https://github.com/rayafort/laravel-subscriptions/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/rayafort/laravel-subscriptions/compare/v1.0.0...v1.0.1
[v1.0.0]: https://github.com/rayafort/laravel-subscriptions/compare/v0.0.4...v1.0.0
[v0.0.4]: https://github.com/rayafort/laravel-subscriptions/compare/v0.0.3...v0.0.4
[v0.0.3]: https://github.com/rayafort/laravel-subscriptions/compare/v0.0.2...v0.0.3
[v0.0.2]: https://github.com/rayafort/laravel-subscriptions/compare/v0.0.1...v0.0.2
