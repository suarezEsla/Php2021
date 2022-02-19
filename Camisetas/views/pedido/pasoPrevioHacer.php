<?php if (isset($_SESSION['identity'])) : ?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>
    <br />

    <h3>Dirección para el envio:</h3>

    <form action="<?= base_url . 'pedido/direccionHabitual' ?>" method="POST">

        Utilizar la dirección habitual

        <input type="radio" name="direccionHabitual" value="direccionHabitual"><br>
        Utilizar nueva direccion
        <input type="radio" name="nuevaDireccion" value="nuevaDireccion">
        &nbsp;


        <input type="submit" value="Confirmar dirección de envío" />
    </form>

<?php else : ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>