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
 * Class Finnish
 *
 * @package PhpScience\TextRank\Tool\StopWords
 */
class Finnish extends StopWordsAbstract
{
    /**
     * Stop words for avoid dummy keywords for Language Finnish.
     *
     * @var array
     */
    protected $words = [
        'alla',
        'ansiosta',
        'ehkä',
        'ei',
        'enemmän',
        'ennen',
        'etessa',
        'f',
        'haikki',
        'he',
        'hitaasti',
        'hoikein',
        'hyvin',
        'hän',
        'ilman',
        'ja',
        'jos',
        'jälkeen',
        'kanssa',
        'kaukana',
        'kenties',
        'keskellä',
        'kesken',
        'koskaan',
        'kuinkan',
        'kukka',
        'kylliksi',
        'kyllä',
        'liian',
        'lla',
        'lla',
        'luona',
        'lähellä',
        'läpi',
        'me',
        'miksi',
        'mikä',
        'milloin',
        'milloinkan',
        'minä',
        'missä',
        'miten',
        'nopeasti',
        'nyt',
        'oikea',
        'oikealla',
        'paljon',
        'siellä',
        'sinä',
        'ssa',
        'sta',
        'suoraan',
        'tai',
        'takana',
        'takia',
        'tarpeeksi',
        'te',
        'tässä',
        'ulkopuolella',
        'vahemmän',
        'vasen',
        'vasenmalla',
        'vastan',
        'vielä',
        'vieressä',
        'vähän',
        'yhdessä',
        'ylös',
    ];
}
