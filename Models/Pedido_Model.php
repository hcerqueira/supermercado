<?php 

class PedidoModel{
    private $idPedido;
    private $userId;
    private $status;
    private $dataDaCompra;
    private $pedidoAvaliado;

    public function __construct($userId, $status) {
        $this->userId = $userId;
        $this->status = $status;
        $this->dataDaCompra = (new DateTime("now", new DateTimeZone('America/Sao_Paulo')))->format('Y-m-d H:i:s');
        $this->pedidoAvaliado = false;
    }

    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->id = $idPedido;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDataDaCompra() {
        return $this->dataDaCompra;
    }

    public function setDataDaCompra($dataDaCompra) {
        $this->dataDaCompra = $dataDaCompra;
    }

    public function getPedidoAvaliado() {
        return $this->pedidoAvaliado;
    }

    public function setPedidoAvaliado($pedidoAvaliado) {
        $this->pedidoAvaliado = $pedidoAvaliado;
    }

}
?>