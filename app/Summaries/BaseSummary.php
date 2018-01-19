<?php

namespace App\Summaries;

use Illuminate\Contracts\Support\Jsonable;

abstract class BaseSummary implements Jsonable
{
    /**
     * determine if has summary data.
     *
     * @var bool
     */
    protected $hasSummary = true;
    /**
     * determines if has table.
     *
     * @var bool
     */
    protected $hasTable = true;
    /**
     * determines if has pie chart.
     *
     * @var bool
     */
    protected $hasCharts = true;
    /**
     * the pie data.
     *
     * @var array
     */
    protected $charts = [];
    /**
     * table data.
     *
     * @var array
     */
    protected $tableData = [];

    /**
     * the class generic data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * generic summary.
     *
     * @var array
     */
    protected $summary = [];

    public function __construct()
    {
        $this->data = $this->getCollection();
    }

    abstract public function getCollection();

    public function toJson($options = 0)
    {
        $summary = $this->finishing($this->data) ?: [];

        if ($this->hasSummary) {
            $summary['summary'] = $this->summary;
        }
        if ($this->hasCharts) {
            $summary['charts'] = $this->charts;
        }
        if ($this->hasTable) {
            $summary['tableData'] = $this->tableData;
        }

        return json_encode($summary, $options);
    }

    public function finishing($data)
    {
        return [];
    }
}
