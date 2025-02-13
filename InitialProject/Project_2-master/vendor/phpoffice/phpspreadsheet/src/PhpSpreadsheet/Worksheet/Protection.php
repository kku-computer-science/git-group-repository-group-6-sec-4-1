<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Shared\PasswordHasher;

class Protection
{
    const ALGORITHM_MD2 = 'MD2';
    const ALGORITHM_MD4 = 'MD4';
    const ALGORITHM_MD5 = 'MD5';
    const ALGORITHM_SHA_1 = 'SHA-1';
    const ALGORITHM_SHA_256 = 'SHA-256';
    const ALGORITHM_SHA_384 = 'SHA-384';
    const ALGORITHM_SHA_512 = 'SHA-512';
    const ALGORITHM_RIPEMD_128 = 'RIPEMD-128';
    const ALGORITHM_RIPEMD_160 = 'RIPEMD-160';
    const ALGORITHM_WHIRLPOOL = 'WHIRLPOOL';

    /**
<<<<<<< HEAD
     * Sheet.
     *
     * @var bool
     */
    private $sheet = false;

    /**
     * Objects.
     *
     * @var bool
     */
    private $objects = false;

    /**
     * Scenarios.
     *
     * @var bool
     */
    private $scenarios = false;

    /**
     * Format cells.
     *
     * @var bool
     */
    private $formatCells = false;

    /**
     * Format columns.
     *
     * @var bool
     */
    private $formatColumns = false;

    /**
     * Format rows.
     *
     * @var bool
     */
    private $formatRows = false;

    /**
     * Insert columns.
     *
     * @var bool
     */
    private $insertColumns = false;

    /**
     * Insert rows.
     *
     * @var bool
     */
    private $insertRows = false;

    /**
     * Insert hyperlinks.
     *
     * @var bool
     */
    private $insertHyperlinks = false;

    /**
     * Delete columns.
     *
     * @var bool
     */
    private $deleteColumns = false;

    /**
     * Delete rows.
     *
     * @var bool
     */
    private $deleteRows = false;

    /**
     * Select locked cells.
     *
     * @var bool
     */
    private $selectLockedCells = false;

    /**
     * Sort.
     *
     * @var bool
     */
    private $sort = false;

    /**
     * AutoFilter.
     *
     * @var bool
     */
    private $autoFilter = false;

    /**
     * Pivot tables.
     *
     * @var bool
     */
    private $pivotTables = false;

    /**
     * Select unlocked cells.
     *
     * @var bool
     */
    private $selectUnlockedCells = false;
=======
     * Autofilters are locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $autoFilter;

    /**
     * Deleting columns is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $deleteColumns;

    /**
     * Deleting rows is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $deleteRows;

    /**
     * Formatting cells is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $formatCells;

    /**
     * Formatting columns is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $formatColumns;

    /**
     * Formatting rows is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $formatRows;

    /**
     * Inserting columns is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $insertColumns;

    /**
     * Inserting hyperlinks is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $insertHyperlinks;

    /**
     * Inserting rows is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $insertRows;

    /**
     * Objects are locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $objects;

    /**
     * Pivot tables are locked when the sheet is protected, default true.
     *
     * @var ?bool
     */
    private $pivotTables;

    /**
     * Scenarios are locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $scenarios;

    /**
     * Selection of locked cells is locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $selectLockedCells;

    /**
     * Selection of unlocked cells is locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $selectUnlockedCells;

    /**
     * Sheet is locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $sheet;

    /**
     * Sorting is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $sort;
>>>>>>> main

    /**
     * Hashed password.
     *
     * @var string
     */
    private $password = '';

    /**
     * Algorithm name.
     *
     * @var string
     */
    private $algorithm = '';

    /**
     * Salt value.
     *
     * @var string
     */
    private $salt = '';

    /**
     * Spin count.
     *
     * @var int
     */
    private $spinCount = 10000;

    /**
     * Create a new Protection.
     */
    public function __construct()
    {
    }

    /**
     * Is some sort of protection enabled?
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isProtectionEnabled()
    {
        return $this->sheet ||
            $this->objects ||
            $this->scenarios ||
            $this->formatCells ||
            $this->formatColumns ||
            $this->formatRows ||
            $this->insertColumns ||
            $this->insertRows ||
            $this->insertHyperlinks ||
            $this->deleteColumns ||
            $this->deleteRows ||
            $this->selectLockedCells ||
            $this->sort ||
            $this->autoFilter ||
            $this->pivotTables ||
            $this->selectUnlockedCells;
    }

    /**
     * Get Sheet.
     *
     * @return bool
     */
    public function getSheet()
=======
     */
    public function isProtectionEnabled(): bool
    {
        return
            $this->password !== '' ||
            isset($this->sheet) ||
            isset($this->objects) ||
            isset($this->scenarios) ||
            isset($this->formatCells) ||
            isset($this->formatColumns) ||
            isset($this->formatRows) ||
            isset($this->insertColumns) ||
            isset($this->insertRows) ||
            isset($this->insertHyperlinks) ||
            isset($this->deleteColumns) ||
            isset($this->deleteRows) ||
            isset($this->selectLockedCells) ||
            isset($this->sort) ||
            isset($this->autoFilter) ||
            isset($this->pivotTables) ||
            isset($this->selectUnlockedCells);
    }

    public function getSheet(): ?bool
>>>>>>> main
    {
        return $this->sheet;
    }

<<<<<<< HEAD
    /**
     * Set Sheet.
     *
     * @param bool $sheet
     *
     * @return $this
     */
    public function setSheet($sheet)
=======
    public function setSheet(?bool $sheet): self
>>>>>>> main
    {
        $this->sheet = $sheet;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Objects.
     *
     * @return bool
     */
    public function getObjects()
=======
    public function getObjects(): ?bool
>>>>>>> main
    {
        return $this->objects;
    }

<<<<<<< HEAD
    /**
     * Set Objects.
     *
     * @param bool $objects
     *
     * @return $this
     */
    public function setObjects($objects)
=======
    public function setObjects(?bool $objects): self
>>>>>>> main
    {
        $this->objects = $objects;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Scenarios.
     *
     * @return bool
     */
    public function getScenarios()
=======
    public function getScenarios(): ?bool
>>>>>>> main
    {
        return $this->scenarios;
    }

<<<<<<< HEAD
    /**
     * Set Scenarios.
     *
     * @param bool $scenarios
     *
     * @return $this
     */
    public function setScenarios($scenarios)
=======
    public function setScenarios(?bool $scenarios): self
>>>>>>> main
    {
        $this->scenarios = $scenarios;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get FormatCells.
     *
     * @return bool
     */
    public function getFormatCells()
=======
    public function getFormatCells(): ?bool
>>>>>>> main
    {
        return $this->formatCells;
    }

<<<<<<< HEAD
    /**
     * Set FormatCells.
     *
     * @param bool $formatCells
     *
     * @return $this
     */
    public function setFormatCells($formatCells)
=======
    public function setFormatCells(?bool $formatCells): self
>>>>>>> main
    {
        $this->formatCells = $formatCells;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get FormatColumns.
     *
     * @return bool
     */
    public function getFormatColumns()
=======
    public function getFormatColumns(): ?bool
>>>>>>> main
    {
        return $this->formatColumns;
    }

<<<<<<< HEAD
    /**
     * Set FormatColumns.
     *
     * @param bool $formatColumns
     *
     * @return $this
     */
    public function setFormatColumns($formatColumns)
=======
    public function setFormatColumns(?bool $formatColumns): self
>>>>>>> main
    {
        $this->formatColumns = $formatColumns;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get FormatRows.
     *
     * @return bool
     */
    public function getFormatRows()
=======
    public function getFormatRows(): ?bool
>>>>>>> main
    {
        return $this->formatRows;
    }

<<<<<<< HEAD
    /**
     * Set FormatRows.
     *
     * @param bool $formatRows
     *
     * @return $this
     */
    public function setFormatRows($formatRows)
=======
    public function setFormatRows(?bool $formatRows): self
>>>>>>> main
    {
        $this->formatRows = $formatRows;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get InsertColumns.
     *
     * @return bool
     */
    public function getInsertColumns()
=======
    public function getInsertColumns(): ?bool
>>>>>>> main
    {
        return $this->insertColumns;
    }

<<<<<<< HEAD
    /**
     * Set InsertColumns.
     *
     * @param bool $insertColumns
     *
     * @return $this
     */
    public function setInsertColumns($insertColumns)
=======
    public function setInsertColumns(?bool $insertColumns): self
>>>>>>> main
    {
        $this->insertColumns = $insertColumns;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get InsertRows.
     *
     * @return bool
     */
    public function getInsertRows()
=======
    public function getInsertRows(): ?bool
>>>>>>> main
    {
        return $this->insertRows;
    }

<<<<<<< HEAD
    /**
     * Set InsertRows.
     *
     * @param bool $insertRows
     *
     * @return $this
     */
    public function setInsertRows($insertRows)
=======
    public function setInsertRows(?bool $insertRows): self
>>>>>>> main
    {
        $this->insertRows = $insertRows;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get InsertHyperlinks.
     *
     * @return bool
     */
    public function getInsertHyperlinks()
=======
    public function getInsertHyperlinks(): ?bool
>>>>>>> main
    {
        return $this->insertHyperlinks;
    }

<<<<<<< HEAD
    /**
     * Set InsertHyperlinks.
     *
     * @param bool $insertHyperLinks
     *
     * @return $this
     */
    public function setInsertHyperlinks($insertHyperLinks)
=======
    public function setInsertHyperlinks(?bool $insertHyperLinks): self
>>>>>>> main
    {
        $this->insertHyperlinks = $insertHyperLinks;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get DeleteColumns.
     *
     * @return bool
     */
    public function getDeleteColumns()
=======
    public function getDeleteColumns(): ?bool
>>>>>>> main
    {
        return $this->deleteColumns;
    }

<<<<<<< HEAD
    /**
     * Set DeleteColumns.
     *
     * @param bool $deleteColumns
     *
     * @return $this
     */
    public function setDeleteColumns($deleteColumns)
=======
    public function setDeleteColumns(?bool $deleteColumns): self
>>>>>>> main
    {
        $this->deleteColumns = $deleteColumns;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get DeleteRows.
     *
     * @return bool
     */
    public function getDeleteRows()
=======
    public function getDeleteRows(): ?bool
>>>>>>> main
    {
        return $this->deleteRows;
    }

<<<<<<< HEAD
    /**
     * Set DeleteRows.
     *
     * @param bool $deleteRows
     *
     * @return $this
     */
    public function setDeleteRows($deleteRows)
=======
    public function setDeleteRows(?bool $deleteRows): self
>>>>>>> main
    {
        $this->deleteRows = $deleteRows;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get SelectLockedCells.
     *
     * @return bool
     */
    public function getSelectLockedCells()
=======
    public function getSelectLockedCells(): ?bool
>>>>>>> main
    {
        return $this->selectLockedCells;
    }

<<<<<<< HEAD
    /**
     * Set SelectLockedCells.
     *
     * @param bool $selectLockedCells
     *
     * @return $this
     */
    public function setSelectLockedCells($selectLockedCells)
=======
    public function setSelectLockedCells(?bool $selectLockedCells): self
>>>>>>> main
    {
        $this->selectLockedCells = $selectLockedCells;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Sort.
     *
     * @return bool
     */
    public function getSort()
=======
    public function getSort(): ?bool
>>>>>>> main
    {
        return $this->sort;
    }

<<<<<<< HEAD
    /**
     * Set Sort.
     *
     * @param bool $sort
     *
     * @return $this
     */
    public function setSort($sort)
=======
    public function setSort(?bool $sort): self
>>>>>>> main
    {
        $this->sort = $sort;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get AutoFilter.
     *
     * @return bool
     */
    public function getAutoFilter()
=======
    public function getAutoFilter(): ?bool
>>>>>>> main
    {
        return $this->autoFilter;
    }

<<<<<<< HEAD
    /**
     * Set AutoFilter.
     *
     * @param bool $autoFilter
     *
     * @return $this
     */
    public function setAutoFilter($autoFilter)
=======
    public function setAutoFilter(?bool $autoFilter): self
>>>>>>> main
    {
        $this->autoFilter = $autoFilter;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get PivotTables.
     *
     * @return bool
     */
    public function getPivotTables()
=======
    public function getPivotTables(): ?bool
>>>>>>> main
    {
        return $this->pivotTables;
    }

<<<<<<< HEAD
    /**
     * Set PivotTables.
     *
     * @param bool $pivotTables
     *
     * @return $this
     */
    public function setPivotTables($pivotTables)
=======
    public function setPivotTables(?bool $pivotTables): self
>>>>>>> main
    {
        $this->pivotTables = $pivotTables;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get SelectUnlockedCells.
     *
     * @return bool
     */
    public function getSelectUnlockedCells()
=======
    public function getSelectUnlockedCells(): ?bool
>>>>>>> main
    {
        return $this->selectUnlockedCells;
    }

<<<<<<< HEAD
    /**
     * Set SelectUnlockedCells.
     *
     * @param bool $selectUnlockedCells
     *
     * @return $this
     */
    public function setSelectUnlockedCells($selectUnlockedCells)
=======
    public function setSelectUnlockedCells(?bool $selectUnlockedCells): self
>>>>>>> main
    {
        $this->selectUnlockedCells = $selectUnlockedCells;

        return $this;
    }

    /**
     * Get hashed password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Password.
     *
     * @param string $password
     * @param bool $alreadyHashed If the password has already been hashed, set this to true
     *
     * @return $this
     */
    public function setPassword($password, $alreadyHashed = false)
    {
        if (!$alreadyHashed) {
            $salt = $this->generateSalt();
            $this->setSalt($salt);
            $password = PasswordHasher::hashPassword($password, $this->getAlgorithm(), $this->getSalt(), $this->getSpinCount());
        }

        $this->password = $password;

        return $this;
    }

<<<<<<< HEAD
=======
    public function setHashValue(string $password): self
    {
        return $this->setPassword($password, true);
    }

>>>>>>> main
    /**
     * Create a pseudorandom string.
     */
    private function generateSalt(): string
    {
        return base64_encode(random_bytes(16));
    }

    /**
     * Get algorithm name.
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * Set algorithm name.
     */
<<<<<<< HEAD
    public function setAlgorithm(string $algorithm): void
    {
        $this->algorithm = $algorithm;
    }

    /**
     * Get salt value.
     */
=======
    public function setAlgorithm(string $algorithm): self
    {
        return $this->setAlgorithmName($algorithm);
    }

    /**
     * Set algorithm name.
     */
    public function setAlgorithmName(string $algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }

>>>>>>> main
    public function getSalt(): string
    {
        return $this->salt;
    }

<<<<<<< HEAD
    /**
     * Set salt value.
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
=======
    public function setSalt(string $salt): self
    {
        return $this->setSaltValue($salt);
    }

    public function setSaltValue(string $salt): self
    {
        $this->salt = $salt;

        return $this;
>>>>>>> main
    }

    /**
     * Get spin count.
     */
    public function getSpinCount(): int
    {
        return $this->spinCount;
    }

    /**
     * Set spin count.
     */
<<<<<<< HEAD
    public function setSpinCount(int $spinCount): void
    {
        $this->spinCount = $spinCount;
=======
    public function setSpinCount(int $spinCount): self
    {
        $this->spinCount = $spinCount;

        return $this;
>>>>>>> main
    }

    /**
     * Verify that the given non-hashed password can "unlock" the protection.
     */
    public function verify(string $password): bool
    {
<<<<<<< HEAD
        if (!$this->isProtectionEnabled()) {
=======
        if ($this->password === '') {
>>>>>>> main
            return true;
        }

        $hash = PasswordHasher::hashPassword($password, $this->getAlgorithm(), $this->getSalt(), $this->getSpinCount());

        return $this->getPassword() === $hash;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }
}
