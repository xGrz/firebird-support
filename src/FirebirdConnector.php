<?php

namespace Xgrz\Firebird;

use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use PDO;

class FirebirdConnector extends Connector implements ConnectorInterface
{
    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config): PDO
    {
        return $this->createConnection(
            $this->getDsn($config),
            $config,
            $this->getOptions($config)
        );
    }

    /**
     * Create a DSN string from the configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config): string
    {
        extract($config);

        if (! isset($host) || ! isset($database)) {
            trigger_error('Cannot connect to Firebird Database, no host or database supplied');
        }

        $dsn = "firebird:dbname={$host}";

        if (isset($port)) {
            $dsn .= "/{$port}";
        }

        $dsn .= ":{$database};";

        if (isset($role)) {
            $dsn .= "role={$role};";
        }

        if (isset($charset)) {
            $dsn .= "charset={$charset};";
        }

        return $dsn;
    }
}
