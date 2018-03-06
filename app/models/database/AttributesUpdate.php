<?php
    namespace app\models\database;

    class AttributesUpdate {

        private function combineUpdateFields($attributes) {
            $keys = array_keys($attributes);
            $separadoPorDoisPontos = ':'.implode('=:', $keys);
            $combine = array_combine($keys, explode('=', $separadoPorDoisPontos));
            // array('name' => :name, 'id' => :id)
            return $combine;
        }

        public function updateFields($attributes) {
            $combine = $this->combineUpdateFields($attributes);
            $query = null;
            foreach ($combine as $key => $value) {
                $query .= $key.'='.$value.',';
            }
            $novaQuery = rtrim($query, ',');
            return $novaQuery;
        }

        public function bindUpdateParameters($attributes) {
            $keys = array_keys($attributes);
            $separadoPorDoisPontos = ':'.implode(',:', $keys);
            $combineUpdate = array_combine(explode(',', $separadoPorDoisPontos), array_values($attributes));
            return $combineUpdate;
        }

    }

?>