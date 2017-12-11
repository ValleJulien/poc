<?php

namespace AdminBundle\Dql;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class RandFunction
 * to create RANDOM method for select datas (as nativ SQL RAND() function)
 * @package AdminBundleDql
 */
class RandFunction
{

    /**
     * @param Parser $parser
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return 'RAND()';
    }
}