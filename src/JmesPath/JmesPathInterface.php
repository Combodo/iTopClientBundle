<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 13/09/18
 * Time: 12:14
 */

namespace Combodo\ItopClientBundle\JmesPath;

interface JmesPathInterface
{
    /**
     * @param string $expression
     * @param mixed  $data
     *
     * @return mixed
     */
    public function search(string $expression, $data);

    /**
     * @return void
     */
    public function createRuntime();

    /**
     * @return void
     */
    public function cleanCompileDir();
}
