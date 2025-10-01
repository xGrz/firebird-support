<?php

namespace Xgrz\Firebird;

use Illuminate\Database\Connection as DatabaseConnection;
use Illuminate\Support\Collection;
use Xgrz\Firebird\Query\Builder as FirebirdQueryBuilder;
use Xgrz\Firebird\Query\Grammars\FirebirdGrammar as FirebirdQueryGrammar;
use Xgrz\Firebird\Query\Processors\FirebirdProcessor as FirebirdQueryProcessor;
use Xgrz\Firebird\Schema\Builder as FirebirdSchemaBuilder;
use Xgrz\Firebird\Schema\Grammars\FirebirdGrammar as FirebirdSchemaGrammar;

class FirebirdConnection extends DatabaseConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Illuminate\Database\Query\Grammars\Grammar
     */
    protected function getDefaultQueryGrammar(): FirebirdQueryGrammar
    {
        return new FirebirdQueryGrammar($this);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \Illuminate\Database\Query\Processors\Processor
     */
    protected function getDefaultPostProcessor(): FirebirdQueryProcessor
    {
        return new FirebirdQueryProcessor;
    }

    /**
     * Get a schema builder instance for this connection.
     *
     * @return \Firebird\Schema\Builder
     */
    public function getSchemaBuilder(): FirebirdSchemaBuilder
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new FirebirdSchemaBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \Firebird\Schema\Grammars\FirebirdGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new FirebirdSchemaGrammar);
    }

    /**
     * Get a new query builder instance.
     *
     * @return \Firebird\Query\Builder
     */
    public function query()
    {
        return new FirebirdQueryBuilder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }

    /**
     * Execute a stored procedure.
     *
     * @param  string  $procedure
     * @param  array  $values
     * @return Collection
     */
    public function executeProcedure($procedure, array $values = []): Collection
    {
        return $this->query()->fromProcedure($procedure, $values)->get();
    }
}
