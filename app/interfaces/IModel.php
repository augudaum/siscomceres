<?php

    namespace app\interfaces;

    interface IModel {
        public function create($attributes);
        public function read();
        public function update($id, $attributes);
        public function delete($name, $value);
        public function findBy($name, $value);
    }