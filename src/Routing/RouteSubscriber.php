<?php

namespace Drupal\maintenance_mode_permissions\Routing;

use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {

    $events = parent::getSubscribedEvents();

    // Use a lower priority than \Drupal\field_ui\Routing\RouteSubscriber or
    // \Drupal\views\EventSubscriber\RouteSubscriber to ensure we add the option
    // to their routes.
    $events[RoutingEvents::ALTER] = array('onAlterRoutes', -9999);

    return $events;
  }

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {

    $route = $collection->get('system.site_maintenance_mode');
    $route->setRequirement('_permission', 'administer maintenance mode');

  }

}
