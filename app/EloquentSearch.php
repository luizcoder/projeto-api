<?php

namespace app;

trait EloquentSearch {
    /**
     * Método para busca em todos os campos.
     * Utiliza como referência a variavel 'searchable' (array de campos a serem pesquisados).
     */

    public function scopeSearch($query, $value)
    {
        // Agrupando todas as cláusulas
        $query->where(function($query) use ($value)
        {
            // Cláusula normal para o primeiro campo
            $query->where($this->searchable[0], "like", "%$value%");
            
            // Cláusulas 'or' para os outros campos
            foreach (array_slice($this->searchable, 1) as $campo) {
                $query->orWhere($campo, "like", "%$value%");
            }
        });
        return $query;
    }
}

