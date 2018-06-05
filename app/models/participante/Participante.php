<?php

    namespace app\models\participante;
    
    use app\models\database\DefaultModel;
    use app\models\participante\pessoa\Pessoa;
    use app\models\participante\pessoa\RG;
    use app\models\participante\pessoa\IE;
    use app\models\enderecos\Endereco;
    use app\models\enderecos\Logradouro;
    use app\models\enderecos\Bairro;
    use app\models\contatos\Contato;

    class Participante extends DefaultModel {
        protected $id;
        protected $endereco;
        protected $contato;
        protected $pessoa;
        protected $politicaPagamento;
        protected $table = 'tb_participantes';
        const SEQUENCE = 'tb_participantes_seq';

        /****************************************
        ********** GET and SET methods **********
        ****************************************/

        public function get($id) {
            $p = $this->findBy('id', $id);
            $participante = new Participante();
            $participante->id = $p->id;
            if (strlen($p->cpf_cnpj) > 11) {
                $pessoa = (new Pessoa())->instantiateTipoPessoa('j');
                $pessoa->setTipo('j');
                $pessoa->setRazaoSocial($p->razao_social);
                $pessoa->setNomeFantasia($p->nome_fantasia);
                $pessoa->setCNPJ($p->cpf_cnpj);
                $ie = new IE($p->ie, $p->uf_ie);
                $pessoa->setIE($ie);
                $pessoa->setIM($p->im);
                $pessoa->setCNAE($p->cnae);
                $pessoa->setCRT($p->crt);
                $pessoa->setDataFundacao($p->data_fundacao);
            } else {
                $pessoa = (new Pessoa())->instantiateTipoPessoa('f');
                $pessoa->setTipo('f');
                $pessoa->setNome($p->nome_pessoa);
                $pessoa->setApelido($p->apelido);
                $pessoa->setCPF($p->cpf_cnpj);
                $pessoa->setDataNascimento($p->data_nascimento);
                $rg = new RG($p->numero_rg, $p->orgao_rg, $p->uf_rg, $p->data_expedicao_rg);
                $pessoa->setRG($rg);
            }
            $participante->setPessoa($pessoa);
            $endereco = new Endereco($p->numero_casa, (new Logradouro($p->nome_rua, $p->nome_bairro, $p->cep)), $p->complemento, $p->referencia);
            $participante->setEndereco($endereco);
            return $participante;
        }

        public function getAll() {
            $participantes = $this->all();
            $arrayParticipantes = [];
            foreach ($participantes as $p) {
                $participante = new Participante();
                $participante->id = $p->id;
                if (strlen($p->cpf_cnpj) > 11) {
                    $pessoa = (new Pessoa())->instantiateTipoPessoa('j');
                    $pessoa->setTipo('j');
                    $pessoa->setRazaoSocial($p->razao_social);
                    $pessoa->setNomeFantasia($p->nome_fantasia);
                    $pessoa->setCNPJ($p->cpf_cnpj);
                    $ie = new IE($p->ie, $p->uf_ie);
                    $pessoa->setIE($ie);
                    $pessoa->setIM($p->im);
                    $pessoa->setCNAE($p->cnae);
                    $pessoa->setCRT($p->crt);
                    $pessoa->setDataFundacao($p->data_fundacao);
                } else {
                    $pessoa = (new Pessoa())->instantiateTipoPessoa('f');
                    $pessoa->setTipo('f');
                    $pessoa->setNome($p->nome_pessoa);
                    $pessoa->setApelido($p->apelido);
                    $pessoa->setCPF($p->cpf_cnpj);
                    $pessoa->setDataNascimento($p->data_nascimento);
                    $rg = new RG($p->numero_rg, $p->orgao_rg, $p->uf_rg, $p->data_expedicao_rg);
                    $pessoa->setRG($rg);
                }
                $participante->setPessoa($pessoa);
                $endereco = new Endereco($p->numero_casa, (new Logradouro($p->nome_rua, (new Bairro(null, $p->cidade, $p->nome_bairro)) , $p->cep)), $p->complemento, $p->referencia);
                $participante->setEndereco($endereco);
                $arrayParticipantes[] = $participante;
            }
            return $arrayParticipantes;
        }

        public function getId() {
            return $this->id;
        }

        public function getEndereco() {
            return $this->endereco;
        }

        public function getContato() {
            return $this->contato;
        }

        public function getPessoa() {
            return $this->pessoa;
        }

        public function getPoliticaPagamento() {
            return $this->politicaPagamento;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setEndereco (Endereco $endereco) {
            $this->endereco = $endereco;
        }

        public function setContato (Contato $contato) {
            $this->contato[] = $contato;
        }

        public function setPessoa (Pessoa $pessoa) {
            $this->pessoa = $pessoa;
        }

        public function setPoliticaPagamento (PoliticaPagamento $planoPagamento) {
            $this->politicaPagamento = $planoPagamento;
        }
    }
?>