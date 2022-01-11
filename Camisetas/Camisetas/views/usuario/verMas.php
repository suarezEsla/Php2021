<?php if (isset($usuario)) : ?>
    <table>
        <h1>Más datos sobre el usuario <?= $usuario->id ?></h1>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>e-mail</th>
        </tr>
        <tr>
            <div class="data">

                <td class="descripcion"><?= $usuario->nombre ?></td>
                <td class="description"><?= $usuario->apellidos ?></td>
                <td class="price"><?= $usuario->email ?></td>

            </div>
            </div>
        </tr>
    </table>
    <a href="<?=base_url?>usuario/verPedidos&id=<?=$usuario->id?>" class="button button-mas">Ver pedidos</a>
<?php else : ?>
    <h1>El usuario no existe</h1>
<?php endif; ?>