<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 13/09/18
 * Time: 12:07
 */

namespace Combodo\ItopClientBundle\JmesPath;


use JmesPath\Env;

class JmesPath implements JmesPathInterface
{

    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function search(string $expression, $data)
    {
        return Env::search($expression, $data);
    }

    /**
     * @inheritdoc
     */
    public function createRuntime()
    {
        return Env::createRuntime();
    }

    /**
     * @inheritdoc
     */
    public function cleanCompileDir()
    {
        return Env::cleanCompileDir();
    }

}