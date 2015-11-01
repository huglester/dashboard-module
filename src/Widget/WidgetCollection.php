<?php namespace Anomaly\DashboardModule\Widget;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Class WidgetCollection
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\DashboardModule\Widget
 */
class WidgetCollection extends EntryCollection
{

    /**
     * Return only allowed widgets.
     *
     * @return WidgetCollection
     */
    public function allowed()
    {
        /* @var UserInterface $user */
        if (!$user = app('auth')->user()) {
            return $this->make([]);
        }

        return $this->filter(
            function (WidgetInterface $widget) use ($user) {
                return $user->hasAnyRole($widget->getAllowedRoles());
            }
        );
    }

    /**
     * Return only widgets in
     * the provided column.
     *
     * @param $column
     * @return static
     */
    public function column($column, $over = false)
    {
        return $this->filter(
            function (WidgetInterface $widget) use ($column, $over) {

                if ($widget->getColumn() == $column) {
                    return true;
                }

                if ($over && $widget->getColumn() > $column) {
                    return true;
                }

                return false;
            }
        );
    }
}
