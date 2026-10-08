    <?php $no = 1;
    if($cart->num_rows() > 0){ 
        foreach ($cart->result() as $c => $data) { ?>
    <tr>
        <td class="barcode" style="display:none;"><?=$data->barcode?></td>
        <td>
            <b style="font-size:14px;"><?=$data->item_name?></b><br>
            <small style="color:#666;">@ Rp <?= number_format($data->cart_price,0,',','.')?></small>
            <?php if($data->discount_item > 0) { ?>
                <br><small style="color:#dd4b39;">- Rp <?= number_format($data->discount_item,0,',','.')?> (Diskon)</small>
            <?php } ?>
        </td>
        <td class="text-center qty-cell" style="vertical-align:middle; font-size:16px; font-weight:bold;"><?= $data->qty?></td>
        <td class="text-right" id="total" style="vertical-align:middle; font-weight:bold; font-size:14px;"><?= $data->total?></td>
        <td class="text-center" style="vertical-align:middle;">
            <button id="update_cart" data-toggle="modal" data-target="#modal-item-edit"
            data-cartid="<?=$data->cart_id?>"
            data-barcode="<?=$data->barcode?>"
            data-product="<?=$data->item_name?>"
            data-stock="<?=$data->stock?>"
            data-price="<?=$data->cart_price?>"
            data-qty="<?=$data->qty?>"
            data-discount="<?=$data->discount_item?>"
            data-total="<?=$data->total?>"
            class="btn btn-xs btn-primary" title="Ubah Qty" style="margin-bottom:3px;">
            <i class="fa fa-pencil"></i>
            </button>
            <button id="del_cart" data-cartid="<?=$data->cart_id?>" class="btn btn-xs btn-danger" title="Hapus">
            <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php
        }
    }else{
        echo '<tr>
                <td colspan="4" class="text-center" style="padding: 40px 10px; color: #999;">
                    <i class="fa fa-shopping-cart fa-3x" style="color:#eee; margin-bottom:10px;"></i><br>
                    Belum ada pesanan
                </td>
            </tr>';
    }?>