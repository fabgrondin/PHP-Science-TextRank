<?php
/**
 * PHP Science TextRank (http://php.science/)
 *
 * @see     https://github.com/doveid/php-science-textrank
 * @license https://opensource.org/licenses/MIT the MIT License
 * @author  David Belicza <87.bdavid@gmail.com>
 */

declare(strict_types=1);

namespace PhpScience\TextRank;

use PhpScience\TextRank\Tool\StopWords\English;
use PhpScience\TextRank\Tool\StopWords\Russian;
use PhpScience\TextRank\Tool\StopWords\French;
use PhpScience\TextRank\Tool\StopWords\German;
use PhpScience\TextRank\Tool\StopWords\Italian;
use PhpScience\TextRank\Tool\StopWords\Norwegian;
use PhpScience\TextRank\Tool\StopWords\Spanish;
use PhpScience\TextRank\Tool\StopWords\Arabic;
use PhpScience\TextRank\Tool\StopWords\Catalan;
use PhpScience\TextRank\Tool\StopWords\Danish;
use PhpScience\TextRank\Tool\StopWords\Finnish;
use PhpScience\TextRank\Tool\StopWords\Croation;
use PhpScience\TextRank\Tool\StopWords\Hungarian;
use PhpScience\TextRank\Tool\StopWords\Dutch;
use PhpScience\TextRank\Tool\StopWords\Polish;
use PhpScience\TextRank\Tool\StopWords\Portuguese;
use PhpScience\TextRank\Tool\StopWords\Romanian;
use PhpScience\TextRank\Tool\StopWords\Swedish;
use PhpScience\TextRank\Tool\StopWords\Turkish;
use PhpScience\TextRank\Tool\StopWords\Greek;
use PhpScience\TextRank\Tool\StopWords\Ukrainian;
use PhpScience\TextRank\Tool\Summarize;

class TextRankFacadeTest extends \PHPUnit\Framework\TestCase
{
    protected $sampleText1;

    public function setUp()
    {
        parent::setUp();

        $path =  __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'res'
            . DIRECTORY_SEPARATOR . 'sample1.txt';
        $file = fopen($path, 'r');

        $this->sampleText1 = fread($file, filesize($path));

        fclose($file);
    }

    public function testGetOnlyKeyWords()
    {
        $api = new TextRankFacade();
        $stopWords = new English();
        $api->setStopWords($stopWords);

        $result = $api->getOnlyKeyWords($this->sampleText1);

        $this->assertTrue(count($result) > 0);
        $this->assertTrue(array_values($result)[0] == 1);
    }

    public function testGetHighlights()
    {
        $api = new TextRankFacade();
        $stopWords = new English();
        $api->setStopWords($stopWords);

        $result = $api->getHighlights($this->sampleText1);

        $this->assertTrue(count($result) > 0);
    }

    public function testSummarizeTextCompound()
    {
        $api = new TextRankFacade();
        $stopWords = new English();
        $api->setStopWords($stopWords);

        $result = $api->summarizeTextCompound($this->sampleText1);

        $this->assertTrue(count($result) > 0);
    }

    public function testSummarizeTextBasic()
    {
        $api = new TextRankFacade();
        $stopWords = new English();
        $api->setStopWords($stopWords);

        $result = $api->summarizeTextBasic($this->sampleText1);

        $this->assertTrue(count($result) > 0);
    }

    public function testSummarizeTextFreely()
    {
        $api = new TextRankFacade();
        $stopWords = new English();
        $api->setStopWords($stopWords);

        $result = $api->summarizeTextFreely(
            $this->sampleText1,
            5,
            2,
            Summarize::GET_ALL_IMPORTANT
        );

        $this->assertTrue(count($result) == 2);

        $result = $api->summarizeTextFreely(
            $this->sampleText1,
            10,
            1,
            Summarize::GET_FIRST_IMPORTANT_AND_FOLLOWINGS
        );

        $this->assertTrue(count($result) == 1);

        // Stop words.
        $result = $api->summarizeTextFreely(
            'one two. one two. three four.',
            2,
            10,
            Summarize::GET_ALL_IMPORTANT
        );

        $this->assertTrue(count($result) == 0);

        // Less sentences then expected.
        $result = $api->summarizeTextFreely(
            'lorem ipsum. lorem holy ipsum. sit dolor amet.',
            2,
            10,
            Summarize::GET_ALL_IMPORTANT
        );

        $this->assertTrue(count($result) == 2);
    }

    public function testSmallText()
    {
        $api = new TextRankFacade();
        $stopWords = new English();
        $api->setStopWords($stopWords);

        $result = $api->getOnlyKeyWords('lorem ipsum sit');

        $this->assertEquals(2, count($result));

        $result = $api->getOnlyKeyWords('sit');

        $this->assertEquals(0, count($result));

        $result = $api->getOnlyKeyWords('');

        $this->assertEquals(0, count($result));
    }

    public function testSmallTextRu()
    {
        $api = new TextRankFacade();
        $stopWords = new Russian();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('между холодными ладонями');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('конец');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextFrench()
    {
        $api = new TextRankFacade();
        $stopWords = new French();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Bonjour comment ça-va ?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('comment');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextGerman()
    {
        $api = new TextRankFacade();
        $stopWords = new German();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hallo wie geht es dir');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('wie');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextItalian()
    {
        $api = new TextRankFacade();
        $stopWords = new Italian();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('ciao come stai');
        $this->assertCount(1, $result);

        $result = $api->getOnlyKeyWords('come');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextNorwegian()
    {
        $api = new TextRankFacade();
        $stopWords = new Norwegian();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('hallo hvordan har du det ?');
        $this->assertCount(1, $result);

        $result = $api->getOnlyKeyWords('hvordan');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextSpanish()
    {
        $api = new TextRankFacade();
        $stopWords = new Spanish();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hola como estan amigos ?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('como');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextArabic()
    {
        $api = new TextRankFacade();
        $stopWords = new Arabic();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('مرحبا كيف حالك اصدقاء');
        $this->assertCount(3, $result);

        $result = $api->getOnlyKeyWords('كيف');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextCatalan()
    {
        $api = new TextRankFacade();
        $stopWords = new Catalan();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hola, com sou amics ?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('com');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextDanish()
    {
        $api = new TextRankFacade();
        $stopWords = new Danish();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hej, hvordan har du venner?');
        $this->assertCount(1, $result);

        $result = $api->getOnlyKeyWords('hvordan');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextFinnish()
    {
        $api = new TextRankFacade();
        $stopWords = new Finnish();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hei, miten olet ystäväsi?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('miten');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextCroation()
    {
        $api = new TextRankFacade();
        $stopWords = new Croation();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Kako ste prijatelji?');
        $this->assertCount(1, $result);

        $result = $api->getOnlyKeyWords('ste');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextHungarian()
    {
        $api = new TextRankFacade();
        $stopWords = new Hungarian();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Helló, hogy barátok vagytok?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('hogy');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextDutch()
    {
        $api = new TextRankFacade();
        $stopWords = new Dutch();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hallo hoe gaat het met je vrienden?');
        $this->assertCount(3, $result);

        $result = $api->getOnlyKeyWords('met');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextPolish()
    {
        $api = new TextRankFacade();
        $stopWords = new Polish();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Cześć, jak się masz przyjaciele?');
        $this->assertCount(3, $result);

        $result = $api->getOnlyKeyWords('się');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextPortuguese()
    {
        $api = new TextRankFacade();
        $stopWords = new Portuguese();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Olá, como estão meus amigos?');
        $this->assertCount(1, $result);

        $result = $api->getOnlyKeyWords('meus');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextRomanian()
    {
        $api = new TextRankFacade();
        $stopWords = new Romanian();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Bună ziua cum sunt prietenii mei?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('cum');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextSwedish()
    {
        $api = new TextRankFacade();
        $stopWords = new Swedish();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Hej hur mår mina vänner?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('hur');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextTurkish()
    {
        $api = new TextRankFacade();
        $stopWords = new Turkish();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Merhaba arkadaşlarım nasıl?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('nasıl');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextGreek()
    {
        $api = new TextRankFacade();
        $stopWords = new Greek();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Γεια σας, πως είναι οι φίλοι μου;');
        $this->assertCount(5, $result);

        $result = $api->getOnlyKeyWords('πως');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }

    public function testSmallTextUkrainian()
    {
        $api = new TextRankFacade();
        $stopWords = new Ukrainian();
        $api->setStopWords($stopWords);
        $result = $api->getOnlyKeyWords('Здравствуйте, як ви друзі?');
        $this->assertCount(2, $result);

        $result = $api->getOnlyKeyWords('як');
        $this->assertCount(0, $result);

        $result = $api->getOnlyKeyWords('');
        $this->assertCount(0, $result);
    }
}
