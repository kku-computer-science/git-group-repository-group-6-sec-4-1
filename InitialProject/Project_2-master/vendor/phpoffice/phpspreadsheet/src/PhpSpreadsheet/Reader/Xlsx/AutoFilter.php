<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule;
<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class AutoFilter
{
<<<<<<< HEAD
    private $worksheet;

    private $worksheetXml;

    public function __construct(Worksheet $workSheet, SimpleXMLElement $worksheetXml)
    {
        $this->worksheet = $workSheet;
=======
    /**
     * @var Table|Worksheet
     */
    private $parent;

    /**
     * @var SimpleXMLElement
     */
    private $worksheetXml;

    /**
     * @param Table|Worksheet $parent
     */
    public function __construct($parent, SimpleXMLElement $worksheetXml)
    {
        $this->parent = $parent;
>>>>>>> main
        $this->worksheetXml = $worksheetXml;
    }

    public function load(): void
    {
        // Remove all "$" in the auto filter range
<<<<<<< HEAD
        $autoFilterRange = preg_replace('/\$/', '', $this->worksheetXml->autoFilter['ref'] ?? '');
=======
        $autoFilterRange = (string) preg_replace('/\$/', '', $this->worksheetXml->autoFilter['ref'] ?? '');
>>>>>>> main
        if (strpos($autoFilterRange, ':') !== false) {
            $this->readAutoFilter($autoFilterRange, $this->worksheetXml);
        }
    }

<<<<<<< HEAD
    private function readAutoFilter($autoFilterRange, $xmlSheet): void
    {
        $autoFilter = $this->worksheet->getAutoFilter();
=======
    private function readAutoFilter(string $autoFilterRange, SimpleXMLElement $xmlSheet): void
    {
        $autoFilter = $this->parent->getAutoFilter();
>>>>>>> main
        $autoFilter->setRange($autoFilterRange);

        foreach ($xmlSheet->autoFilter->filterColumn as $filterColumn) {
            $column = $autoFilter->getColumnByOffset((int) $filterColumn['colId']);
            //    Check for standard filters
            if ($filterColumn->filters) {
                $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_FILTER);
                $filters = $filterColumn->filters;
<<<<<<< HEAD
                if ((isset($filters['blank'])) && ($filters['blank'] == 1)) {
                    //    Operator is undefined, but always treated as EQUAL
                    $column->createRule()->setRule(null, '')->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
=======
                if ((isset($filters['blank'])) && ((int) $filters['blank'] == 1)) {
                    //    Operator is undefined, but always treated as EQUAL
                    $column->createRule()->setRule('', '')->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
>>>>>>> main
                }
                //    Standard filters are always an OR join, so no join rule needs to be set
                //    Entries can be either filter elements
                foreach ($filters->filter as $filterRule) {
                    //    Operator is undefined, but always treated as EQUAL
<<<<<<< HEAD
                    $column->createRule()->setRule(null, (string) $filterRule['val'])->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
=======
                    $column->createRule()->setRule('', (string) $filterRule['val'])->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
>>>>>>> main
                }

                //    Or Date Group elements
                $this->readDateRangeAutoFilter($filters, $column);
            }

            //    Check for custom filters
            $this->readCustomAutoFilter($filterColumn, $column);
            //    Check for dynamic filters
            $this->readDynamicAutoFilter($filterColumn, $column);
            //    Check for dynamic filters
            $this->readTopTenAutoFilter($filterColumn, $column);
        }
        $autoFilter->setEvaluated(true);
    }

    private function readDateRangeAutoFilter(SimpleXMLElement $filters, Column $column): void
    {
        foreach ($filters->dateGroupItem as $dateGroupItem) {
            //    Operator is undefined, but always treated as EQUAL
            $column->createRule()->setRule(
<<<<<<< HEAD
                null,
=======
                '',
>>>>>>> main
                [
                    'year' => (string) $dateGroupItem['year'],
                    'month' => (string) $dateGroupItem['month'],
                    'day' => (string) $dateGroupItem['day'],
                    'hour' => (string) $dateGroupItem['hour'],
                    'minute' => (string) $dateGroupItem['minute'],
                    'second' => (string) $dateGroupItem['second'],
                ],
                (string) $dateGroupItem['dateTimeGrouping']
            )->setRuleType(Rule::AUTOFILTER_RULETYPE_DATEGROUP);
        }
    }

<<<<<<< HEAD
    private function readCustomAutoFilter(SimpleXMLElement $filterColumn, Column $column): void
    {
        if ($filterColumn->customFilters) {
=======
    private function readCustomAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->customFilters)) {
>>>>>>> main
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_CUSTOMFILTER);
            $customFilters = $filterColumn->customFilters;
            //    Custom filters can an AND or an OR join;
            //        and there should only ever be one or two entries
            if ((isset($customFilters['and'])) && ((string) $customFilters['and'] === '1')) {
                $column->setJoin(Column::AUTOFILTER_COLUMN_JOIN_AND);
            }
            foreach ($customFilters->customFilter as $filterRule) {
                $column->createRule()->setRule(
                    (string) $filterRule['operator'],
                    (string) $filterRule['val']
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_CUSTOMFILTER);
            }
        }
    }

<<<<<<< HEAD
    private function readDynamicAutoFilter(SimpleXMLElement $filterColumn, Column $column): void
    {
        if ($filterColumn->dynamicFilter) {
=======
    private function readDynamicAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->dynamicFilter)) {
>>>>>>> main
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_DYNAMICFILTER);
            //    We should only ever have one dynamic filter
            foreach ($filterColumn->dynamicFilter as $filterRule) {
                //    Operator is undefined, but always treated as EQUAL
                $column->createRule()->setRule(
<<<<<<< HEAD
                    null,
=======
                    '',
>>>>>>> main
                    (string) $filterRule['val'],
                    (string) $filterRule['type']
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_DYNAMICFILTER);
                if (isset($filterRule['val'])) {
                    $column->setAttribute('val', (string) $filterRule['val']);
                }
                if (isset($filterRule['maxVal'])) {
                    $column->setAttribute('maxVal', (string) $filterRule['maxVal']);
                }
            }
        }
    }

<<<<<<< HEAD
    private function readTopTenAutoFilter(SimpleXMLElement $filterColumn, Column $column): void
    {
        if ($filterColumn->top10) {
=======
    private function readTopTenAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->top10)) {
>>>>>>> main
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_TOPTENFILTER);
            //    We should only ever have one top10 filter
            foreach ($filterColumn->top10 as $filterRule) {
                $column->createRule()->setRule(
                    (
                        ((isset($filterRule['percent'])) && ((string) $filterRule['percent'] === '1'))
                        ? Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT
                        : Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_BY_VALUE
                    ),
                    (string) $filterRule['val'],
                    (
                        ((isset($filterRule['top'])) && ((string) $filterRule['top'] === '1'))
                        ? Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP
                        : Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_BOTTOM
                    )
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_TOPTENFILTER);
            }
        }
    }
}
