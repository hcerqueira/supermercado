<?php
class PedidoItemService{
  public function create($pedidoItem) {
    $idProduto = $pedidoItem->getIdProduto();
    $preco = $pedidoItem->getPrecoPedido();
    $quantidade = $pedidoItem->getQuantidadePedido();
    $idPedido = $pedidoItem->getIdPedido();

    try {
      $conexao = Conexao::conectar();
      $sql = "INSERT INTO pedidosItem(idPedido, idProduto, quantidadePedido, precoPedido) VALUES (:idPedidoItem, :idProduto, :quantidadePedido, :precoPedido)";
      $stmt = $conexao -> prepare($sql);
      $stmt -> bindParam(":precoPedido", $preco);
      $stmt -> bindParam(":idProduto", $idProduto);
      $stmt -> bindParam(":quantidadePedido", $quantidade);
      $stmt -> bindParam(":idPedido", $idPedido);

      $stmt -> execute();

      $id = $conexao -> lastInsertId();
      $pedidoItem->setIdPedido($id);

      return $pedidoItem;
    } catch (PDOException $e) {
      return null;
    }
  }

  public function delete($pedidoItem) {
    $id = $pedidoItem->getIdPedidoItem();

    try {
      $conexao = Conexao::conectar();
      $sql = "DELETE FROM pedidosItem WHERE idPedidoItem = :id";
      $stmt = $conexao -> prepare($sql);
      $stmt -> bindParam(":id", $id);

      $stmt -> execute();

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function update($pedidoItem) {
    $id = $pedidoItem->getIdPedidoItem();
    $idProduto = $pedidoItem->getIdProduto();
    $preco = $pedidoItem->getPrecoPedido();
    $quantidade = $pedidoItem->getQuantidadePedido();
    $idPedido = $pedidoItem->getIdPedido();

    try {
      $conexao = Conexao::conectar();
      $sql = "UPDATE pedidosItem SET idProduto=:idProduto, idPedido=:idPedido, quantidadePedido=:quantidade, precoPedido=:preco WHERE idPedidoItem = :id";
      $stmt = $conexao -> prepare($sql);
      $stmt -> bindParam(":id", $id);
      $stmt -> bindParam(":idProduto", $idProduto);
      $stmt -> bindParam(":preco", $preco);
      $stmt -> bindParam(":quantidade", $quantidade);
      $stmt -> bindParam(":idPedido", $idPedido);

      $stmt -> execute();

      return $pedidoItem;
    } catch (PDOException $e) {
      return null;
    }
  }

  public function updateQuantity($pedidoItem)
  {
    $id = $pedidoItem->getIdPedidoItem();
    $quantidade = $pedidoItem->getQuantidadePedido();
    
    try {
      $conexao = Conexao::conectar();
      $sql = "UPDATE pedidosItem SET  quantidadePedido=:quantidade WHERE idPedidoItem = :id";
      $stmt = $conexao->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":quantidade", $quantidade);

      $stmt->execute();

      return $pedidoItem;
    } catch (PDOException $e) {
      return null;
    }
  }

public function getPedidosItemByIdPedido($pedido) {
    $idPedido = $pedido->getIdPedidoItem();

    try {
      $conexao = Conexao::conectar();
      $sql = "SELECT * FROM pedidosItem AS i JOIN produtos AS p ON p.idProduto = i.idProduto WHERE idPedido = :idPedido";
      $stmt = $conexao -> prepare($sql);
      $stmt -> bindParam(":idPedido", $idPedido);
      
      $stmt -> execute();
      
      return $stmt -> fetchAll();
    } catch (PDOException $e) {
      return null;
    }
  }

  public function getPedidosItemByIdPedidoAndIdIProduto($pedidoItem)
  {
    $idPedido = $pedidoItem->getIdPedido();
    $idProduto = $pedidoItem->getIdProduto();

    try {
      $conexao = Conexao::conectar();
      $sql = "SELECT * FROM pedidosItem WHERE idPedido = :idPedido AND idProduto = :idProduto";
      $stmt = $conexao->prepare($sql);
      $stmt->bindParam(":idPedido", $idPedido);
      $stmt->bindParam(":idProduto", $idProduto);

      $stmt->execute();

      $data = $stmt->fetch();

      $pedidoItem = new PedidoItemModel($data["idProduto"], $data["precoPedido"], $data["quantidadePedido"], $data["idPedido"]);
      $pedidoItem -> setIdPedidoItem($data["idPedidoItem"]);

      return $pedidoItem;
    } catch (PDOException $e) {
      return null;
    }
  }

}