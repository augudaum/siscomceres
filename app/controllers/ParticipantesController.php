<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\participante\Participante;
    use app\models\contatos\Contato;

    class ParticipantesController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $participantes = (new Participante())->getAll();

            $this->view([
                'title' => 'Painel Administrativo :: Participantes',
                'class_participantes_selected' => 'active',
                'participantes' => $participantes
            ], 'participantes.index');
        }

        public function store() {
            $_POST['cpf_cnpj'] = request()->get()->tipo_pessoa == 'f' ? request()->get()->cpf : request()->get()->cnpj;
            unset($_POST['action'], $_POST['cnpj'], $_POST['cpf'], $_POST['tipo_pessoa']);
            // $contato = array(
            //     "tipo_contato" => request()->get()->tipo_contato,
            //     "valor" => request()->get()->valor,
            //     "categoria" => request()->get()->categoria,
            //     "observacao" => request()->get()->observacao,
            //     "whatsapp" => isset(request()->get()->whatsapp) ? request()->get()->whatsapp : 0
            // );
            unset($_POST['tipo_contato'], $_POST['valor'], $_POST['categoria'], $_POST['observacao'], $_POST['whatsapp']);
            // Remove os campos que foram enviados em branco
            $_POST = array_filter($_POST);
            $participanteId = (new Participante())->create((array) request()->get());
            // Retorna o id do participante inserido
            return toJson($participanteId);
        }

        public function storeContato() {
            return toJson((new Contato())->create((array) request()->get()));
        }

        public function update() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['action'])) {
                return back();
            }
            $_POST['cpf_cnpj'] = request()->get()->tipo_pessoa == 'f' ? request()->get()->cpf : request()->get()->cnpj;
            // $contato = array(
            //     "participante_id" => request()->get()->id,
            //     "tipo_contato" => request()->get()->tipo_contato,
            //     "valor" => request()->get()->valor,
            //     "categoria" => request()->get()->categoria,
            //     "observacao" => request()->get()->observacao,
            //     "whatsapp" => isset(request()->get()->whatsapp) ? request()->get()->whatsapp : 0
            // );
            // Remove os campos, que foram enviados do formulário, mas que não fazem parte da tabela de participantes
            unset($_POST['action'], $_POST['cnpj'], $_POST['cpf'], $_POST['tipo_pessoa'], $_POST['tipo_contato'], $_POST['valor'], $_POST['categoria'], $_POST['observacao'], $_POST['whatsapp']);
            $_POST = array_filter($_POST);
            // Deleta o contato do banco
            (new Contato())->delete('participante_id', request()->get()->id);
            return toJson((new Participante())->update(request()->get()->id, (array) request()->get()));
        }

        public function show() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['id'])) {
                return redirect("/");
            }
            return toJson(array(
                "participante" => (new Participante())->findBy('id', request()->get()->id), 
                "contato" => (new Contato())->findby('participante_id', request()->get()->id))
            );
        }

        public function destroy() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['action'])) {
                return back();
            }
            return toJson((new Participante())->delete('id', request()->get()->id));
        }
    }
?>