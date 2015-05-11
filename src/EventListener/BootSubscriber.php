<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\EloquentBundle\EventListener;

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * BootSubscriber
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 1.0
 */
class BootSubscriber implements EventSubscriberInterface
{
    /**
     * @var Capsule
     */
    protected $capsule;

    /**
     * @param Capsule $capsule
     */
    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST  => 'bootEloquent',
            ConsoleEvents::COMMAND => 'bootEloquent',
        );
    }

    /**
     * Boot Eloquent
     */
    public function bootEloquent()
    {
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}
