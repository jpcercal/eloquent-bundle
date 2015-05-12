<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\EloquentBundle\Tests\EventListener;

use Cekurte\EloquentBundle\EventListener\BootSubscriber;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class BootSubscriberTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 1.0
 */
class BootSubscriberTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsEventSubscriberInterface()
    {
        $reflection = new \ReflectionClass('\\Cekurte\\EloquentBundle\\EventListener\\BootSubscriber');

        $this->assertTrue($reflection->implementsInterface(
            '\\Symfony\\Component\\EventDispatcher\\EventSubscriberInterface'
        ));
    }

    public function testConstruct()
    {
        $mockCapsule = $this->getMock('\\Illuminate\\Database\\Capsule\\Manager');

        $bootSubscriber = new BootSubscriber($mockCapsule);

        $class = new \ReflectionClass($bootSubscriber);

        $reflectionProperty = $class->getProperty('capsule');
        $reflectionProperty->setAccessible(true);

        $this->assertEquals($mockCapsule, $reflectionProperty->getValue($bootSubscriber));
    }

    public function testStaticMethodGetSubscribedEvents()
    {
        $events = BootSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(KernelEvents::REQUEST, $events);
        $this->assertArrayHasKey(ConsoleEvents::COMMAND, $events);

        $this->assertEquals($events[KernelEvents::REQUEST], 'bootEloquent');
        $this->assertEquals($events[ConsoleEvents::COMMAND], 'bootEloquent');
    }

    public function testBootEloquent()
    {
        $mockCapsule = $this->getMock('\\Illuminate\\Database\\Capsule\\Manager');

        $mockCapsule
            ->expects($this->once())
            ->method('setAsGlobal')
            ->willReturn(null)
        ;

        $mockCapsule
            ->expects($this->once())
            ->method('bootEloquent')
            ->willReturn(null)
        ;

        $bootSubscriber = new BootSubscriber($mockCapsule);

        $bootSubscriber->bootEloquent();
    }
}
