<?php

declare(strict_types=1);

namespace RayaFort\Subscriptions;

use RayaFort\Subscriptions\Models\Plan;
use Illuminate\Support\ServiceProvider;
use Rinvex\Support\Traits\ConsoleTools;
use RayaFort\Subscriptions\Models\PlanFeature;
use RayaFort\Subscriptions\Models\PlanSubscription;
use RayaFort\Subscriptions\Models\PlanSubscriptionUsage;
use RayaFort\Subscriptions\Console\Commands\MigrateCommand;
use RayaFort\Subscriptions\Console\Commands\PublishCommand;
use RayaFort\Subscriptions\Console\Commands\RollbackCommand;

class SubscriptionsServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.rayafort.subscriptions.migrate',
        PublishCommand::class => 'command.rayafort.subscriptions.publish',
        RollbackCommand::class => 'command.rayafort.subscriptions.rollback',
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(realpath( __DIR__ . '/../config/config.php' ), 'subscriptions');

        // Bind eloquent models to IoC container
        $this->app->singleton('rayafort.subscriptions.plan', $planModel = $this->app['config']['rayafort.subscriptions.models.plan']);
        $planModel === Plan::class || $this->app->alias('rayafort.subscriptions.plan', Plan::class);

        $this->app->singleton('rayafort.subscriptions.plan_feature', $planFeatureModel = $this->app['config']['rayafort.subscriptions.models.plan_feature']);
        $planFeatureModel === PlanFeature::class || $this->app->alias('rayafort.subscriptions.plan_feature', PlanFeature::class);

        $this->app->singleton('rayafort.subscriptions.plan_subscription', $planSubscriptionModel = $this->app['config']['rayafort.subscriptions.models.plan_subscription']);
        $planSubscriptionModel === PlanSubscription::class || $this->app->alias('rayafort.subscriptions.plan_subscription', PlanSubscription::class);

        $this->app->singleton('rayafort.subscriptions.plan_subscription_usage', $planSubscriptionUsageModel = $this->app['config']['rayafort.subscriptions.models.plan_subscription_usage']);
        $planSubscriptionUsageModel === PlanSubscriptionUsage::class || $this->app->alias('rayafort.subscriptions.plan_subscription_usage', PlanSubscriptionUsage::class);

        // Register console commands
        ! $this->app->runningInConsole() || $this->registerCommands();
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishesConfig('rayafort/subscriptions');
        ! $this->app->runningInConsole() || $this->publishesMigrations('rayafort/subscriptions');
    }
}
