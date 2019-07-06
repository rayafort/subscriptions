<?php
declare(strict_types=1);

return [

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \RayaFort\Subscriptions\Models\Plan::class,
        'plan_feature' => \RayaFort\Subscriptions\Models\PlanFeature::class,
        'plan_subscription' => \RayaFort\Subscriptions\Models\PlanSubscription::class,
        'plan_subscription_usage' => \RayaFort\Subscriptions\Models\PlanSubscriptionUsage::class,

    ],

];
