<?php
namespace Manialib\Gbx\Map;

class Times
{
    /**
     * @var int
     */
    protected $bronze;
    /**
     * @var int
     */
    protected $silver;
    /**
     * @var int
     */
    protected $gold;
    /**
     * @var int
     */
    protected $authortime;
    /**
     * @var int
     */
    protected $authorscore;

    /**
     * @param int $bronze
     * @param int $silver
     * @param int $gold
     * @param int $authortime
     * @param int $authorscore
     */
    public function __construct($bronze, $silver, $gold, $authortime, $authorscore)
    {
        $this->bronze = $bronze;
        $this->silver = $silver;
        $this->gold = $gold;
        $this->authortime = $authortime;
        $this->authorscore = $authorscore;
    }

    /**
     * @return int
     */
    public function getBronze()
    {
        return $this->bronze;
    }

    /**
     * @return int
     */
    public function getSilver()
    {
        return $this->silver;
    }

    /**
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * @return int
     */
    public function getAuthortime()
    {
        return $this->authortime;
    }

    /**
     * @return int
     */
    public function getAuthorscore()
    {
        return $this->authorscore;
    }
}