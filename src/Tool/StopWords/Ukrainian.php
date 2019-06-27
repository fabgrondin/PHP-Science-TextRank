<?php
/**
 * PHP Science TextRank (http://php.science/)
 *
 * @see     https://github.com/doveid/php-science-textrank
 * @license https://opensource.org/licenses/MIT the MIT License
 * @author  David Belicza <87.bdavid@gmail.com>
 */

declare(strict_types=1);

namespace PhpScience\TextRank\Tool\StopWords;

/**
 * Class Ukrainian
 *
 * @package PhpScience\TextRank\Tool\StopWords
 */
class Ukrainian extends StopWordsAbstract
{
    /**
     * Stop words for avoid dummy keywords for Language Ukrainian.
     * Source: https://github.com/stopwords-iso/stopwords-uk
     *
     * @var array
     */
    protected $words = [
        'але',
        'ви',
        'вона',
        'вони',
        'воно',
        'він',
        'в╡д',
        'з',
        'й',
        'коли',
        'ми',
        'нам',
        'про',
        'та',
        'ти',
        'хоча',
        'це',
        'цей',
        'чи',
        'чого',
        'що',
        'як',
        'яко╞',
        'із',
        'інших',
        '╙',
        '╞х',
        '╡'
    ];
}
