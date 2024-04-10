<?php

/*
File: QueryBuilder.php
Created By: Jalen Vaughn
Date: 4/9/2024
Description: 
*/

trait QueryBuilder {
    protected ?string $table = null;
    protected string $select = '*';
    protected array $where = [];
    protected ?array $orderBy = null;
    protected ?int $limit = null;
    
    // Set the table to query from
    public function from(string $table): static {
        $this->table = $table;
        return $this;
    }
    
    // Select specific columns
    protected function select($columns): static {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }
    
    // Add a WHERE condition
    protected function where($column, $operator, $value): static {
        $this->where[] = compact('column', 'operator', 'value');
        return $this;
    }
    
    // Order the results
    protected function orderBy($column, $direction = 'ASC'): static {
        $this->orderBy = compact('column', 'direction');
        return $this;
    }
    
    // Limit the number of results
    protected function limit(int $count): static {
        $this->limit = $count;
        return $this;
    }
    
    // Build the SQL query
    protected function build(): string {
        if (!$this->table) {
            throw new RuntimeException("Table name not specified.");
        }
        
        $query = "SELECT {$this->select} FROM {$this->table}";
        
        if (!empty($this->where)) {
            $query .= ' WHERE ';
            foreach ($this->where as $condition) {
                $query .= "{$condition['column']} {$condition['operator']} '{$condition['value']}' AND ";
            }
            $query = rtrim($query, ' AND ');
        }
        
        if ($this->orderBy) {
            $query .= " ORDER BY {$this->orderBy['column']} {$this->orderBy['direction']}";
        }
        
        if ($this->limit) {
            $query .= " LIMIT {$this->limit}";
        }
        
        return $query;
    }
}
