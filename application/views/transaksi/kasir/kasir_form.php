<style>
    /* Modern POS Styling */
    .pos-item-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 15px;
        padding-bottom: 20px;
    }
    .pos-item-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 120px;
    }
    .pos-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        border-color: #333;
    }
    .pos-item-card:active {
        transform: translateY(1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .pos-item-name {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 10px;
        color: #333;
        word-wrap: break-word;
    }
    .pos-item-price {
        font-size: 16px;
        font-weight: 900;
        color: #00a65a;
    }
    .pos-item-stock {
        font-size: 11px;
        color: #777;
        margin-top: 5px;
    }
    .cart-container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        height: 75vh;
    }
    .cart-totals {
        background: #f9f9f9;
        padding: 15px;
        border-top: 1px solid #eee;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .cart-total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .cart-grand-total {
        font-size: 28px;
        font-weight: bold;
        color: #111;
        border-top: 2px dashed #ccc;
        padding-top: 10px;
        margin-top: 5px;
    }
    #hidden-inputs { display: none; }
</style>

<section class="content-header">
  <h1>Mesin Kasir <small>POS Modern</small></h1>
</section>

<section class="content">
    <div class="row">
        <!-- LEFT PANEL: ITEM GRID (col-md-8) -->
        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-body" style="background-color: #f4f6f9; height: 75vh; overflow-y: auto;">
                    <div class="pos-item-grid">
                        <?php foreach($item as $i => $data){ ?>
                            <div class="pos-item-card" 
                                 onclick="addToCartFromGrid('<?=$data->item_id?>', '<?=$data->barcode?>', '<?=$data->price?>', '<?=$data->stock?>')">
                                <div class="pos-item-name"><?= $data->name ?></div>
                                <div>
                                    <div class="pos-item-price"><?= indo_currency($data->price) ?></div>
                                    <div class="pos-item-stock">Stok: <?= $data->stock ?> <?= $data->unit_name ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL: CART & PAYMENT (col-md-4) -->
        <div class="col-md-4">
            <div class="cart-container">
                <!-- Customer & Info Header -->
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <div class="row">
                        <div class="col-xs-6">
                            <label style="font-size:12px;">Customer</label>
                            <select id="customer" class="form-control input-sm">
                                <?php foreach($customer as $c => $value){
                                    echo '<option value="'.$value->customer_id.'">'.$value->name.'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label style="font-size:12px;">No Meja</label>
                            <input type="text" id="no_meja" name="no_meja" class="form-control input-sm" placeholder="Opsional">
                        </div>
                    </div>
                    <!-- Hidden fields for compatibility -->
                    <div id="hidden-inputs">
                        <input type="date" id="date" value="<?= date('Y-m-d') ?>">
                        <input type="text" id="note" value="-">
                    </div>
                </div>

                <!-- Cart Table (Scrollable) -->
                <div style="flex-grow: 1; overflow-y: auto; padding: 10px;">
                    <table class="table table-striped table-condensed" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th width="15%" class="text-center">Qty</th>
                                <th width="25%" class="text-right">Total</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cart-table">
                            <?php $this->view('transaksi/kasir/cart_data')?>
                        </tbody>
                    </table>
                </div>

                <!-- Totals & Payment (Fixed at bottom) -->
                <div class="cart-totals">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-6">
                            <label style="font-size:12px;">Diskon (Rp)</label>
                            <input type="number" id="diskon" value="0" min="0" class="form-control input-sm text-right">
                        </div>
                        <div class="col-xs-6">
                            <label style="font-size:12px;">Tunai / Cash (Rp)</label>
                            <input type="number" id="cash" value="0" min="0" class="form-control input-sm text-right" style="font-weight:bold; color:green; font-size:16px;">
                        </div>
                    </div>

                    <div class="cart-total-row">
                        <span>Subtotal</span>
                        <b>Rp <input type="text" id="sub_total" readonly style="border:none; background:transparent; width:100px; text-align:right;"></b>
                    </div>
                    <div class="cart-total-row">
                        <span>Kembali</span>
                        <b>Rp <input type="text" id="change" readonly style="border:none; background:transparent; width:100px; text-align:right; color:#dd4b39;"></b>
                    </div>
                    <div class="cart-total-row cart-grand-total">
                        <span>TOTAL</span>
                        <span>Rp <span id="grand_total2">0</span></span>
                        <input type="hidden" id="grand_total">
                    </div>
                    
                    <div style="margin-top: 15px; display:flex; gap:10px;">
                        <button id="batal_pembelian" class="btn btn-default btn-lg" style="flex:1;">Batal</button>
                        <button id="proses_pembelian" class="btn btn-success btn-lg" style="flex:3; font-weight:bold;"><i class="fa fa-shopping-cart"></i> BAYAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Ubah Barang (Kept intact for edit cart functionality) -->
<div class="modal fade" id="modal-item-edit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" >Update Item</h4>
      </div>
      <div class="modal-body">
				<input type="hidden" id="cartid_item">
				<div class="form-group">
					<label for="">Produk Item</label>
					<div class="row">
						<div class="col-md-5">
							<input type="text" id="barcode_item" class="form-control" readonly>
						</div>
						<div class="col-md-7">
							<input type="text" id="produk_item" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Harga</label>
					<input type="number" id="harga_item" min="1000" class="form-control" readonly>
				</div>
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <label for="">Qty</label>
                            <input type="number" id="qty_item" min="1" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="">Stock</label>
                            <input type="number" id="stock_item" class="form-control" readonly>
                        </div>
                    </div>
				</div>
				<div class="form-group">
					<label for="">Total Harga Sebelum Diskon</label>
					<input type="number" id="total_before" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="">Diskon Per Item</label>
					<input type="number" id="discount_item" min="0" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Total Harga Setelah Diskon</label>
					<input type="number" id="total_item" class="form-control" readonly>
				</div>
				<div class="modal-footer">
					<div class="pull-right">
						<button type="button" id="edit_cart" class="btn btn-flat btn-success">
						<i class="fa fa-paper-plane"> Save</i>
						</button>
					</div>
				</div>

      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/')?>dist/js/jquery-1.11.1.min.js"></script>
<script>
    // New Grid Add to Cart Function
    function addToCartFromGrid(item_id, barcode, price, stock) {
        var qty = 1; // Default add 1
        
        // Cek qty di keranjang saat ini
        var qty_cart = 0;
        $('#cart-table tr').each(function(){
            var found_qty = $(this).find("td.barcode:contains('"+barcode+"')").parent().find("td.qty-cell").text();
            if(found_qty != ''){
                qty_cart = parseInt(found_qty);
            }
        });

        if (stock < 1) {
            alert('Stock Habis!');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?= site_url('kasir/proses')?>',
            data: {'add_cart' : true, 'item_id' : item_id, 'price' : price, 'qty' : qty},
            dataType: 'json',
            success: function(result){
                if(result.success == true){
                    $('#cart-table').load('<?=site_url('kasir/cart_data')?>', function(){
                        calculate();
                    });
                }else{
                    alert('Gagal Tambah Item Ke Keranjang');
                }
            }
        });
    }

	$(document).on('click','#del_cart', function(){
		if(confirm('Apakah Anda Yakin ?')){
			var cart_id = $(this).data('cartid')
			$.ajax({
				type :'POST',
				url  : '<?= site_url('kasir/cart_del')?>',
				data : {'cart_id' : cart_id},
				dataType: 'json',
				success: function(result){
					if(result.success == true){
						$('#cart-table').load('<?=site_url('kasir/cart_data')?>', function(){
							calculate()
						})
					}else{
						alert('Gagal Hapus Item')
					}
				}
			})
		}
	})

	$(document).on('click','#update_cart', function(){
		$('#cartid_item').val($(this).data('cartid'))
		$('#barcode_item').val($(this).data('barcode'))
        $('#produk_item').val($(this).data('product'))
        $('#stock_item').val($(this).data('stock'))
		$('#harga_item').val($(this).data('price'))
		$('#qty_item').val($(this).data('qty'))
		$('#total_before').val($(this).data('price') * $(this).data('qty'))
		$('#discount_item').val($(this).data('discount'))
		$('#total_item').val($(this).data('total'))
  })

	function count_edit_modal(){
		var price = $('#harga_item').val()
		var qty = $('#qty_item').val()
		var discount = $('#discount_item').val()

		total_before = price * qty
		$('#total_before').val(total_before)

		total = (price - discount) * qty
		$('#total_item').val(total)

		if(discount == ''){
			$('#discount_item').val(0)
		}
	}

	$(document).on('keyup mouseup', '#harga_item, #qty_item, #discount_item', function(){
		count_edit_modal()
	})

	$(document).on('click','#edit_cart', function(){
		var cart_id = $('#cartid_item').val()
		var price = $('#harga_item').val()
		var qty = $('#qty_item').val()
		var discount = $('#discount_item').val()
        var total = $('#total_item').val()
        var stock = $('#stock_item').val()

		if(price == '' || price < 1 ){
			alert ('Harga Tidak Boleh Kosong')
			$('#harga_item').focus()
		}else if(qty == '' || qty < 1 ){
			alert('Jumlah Barang Minimal 1')
			$('#qty_item').focus('')
		}else if(parseInt(qty) > parseInt(stock)){
			alert('Stock Tidak Mencukupi')
			$('#qty_item').focus('')
		}else{
			$.ajax({
				type :'POST',
				url  : '<?= site_url('kasir/proses')?>',
				data : {'edit_cart' : true, 'cart_id' : cart_id, 'price' : price, 'qty' : qty, 'discount' : discount, 'total' : total},
				dataType: 'json',
				success: function(result){
					if(result.success == true){
						$('#cart-table').load('<?=site_url('kasir/cart_data')?>', function(){
							calculate()
						})
						$('#modal-item-edit').modal('hide')
					}else{
                        alert('Data Keranjang Tidak Terubah')
                        $('#modal-item-edit').modal('hide')
					}
				}
			})
		}
	})

	function calculate(){
		var subtotal = 0;
		$('#cart-table tr').each(function(){
			subtotal += parseInt($(this).find('#total').text())
		})
		isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

		var discount = $('#diskon').val()
		var grand_total = subtotal - discount
		if(isNaN(grand_total)){
			$('#grand_total').val(0)
			$('#grand_total2').text(0)
		}else{
			$('#grand_total').val(grand_total)
			$('#grand_total2').text(grand_total.toLocaleString('id-ID'))
		}

		var cash = $('#cash').val();
		cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)
		
		if(discount == ''){
			$('#diskon').val(0)
		}
	}

	$(document).on('keyup mouseup', '#diskon, #cash', function(){
		calculate()
	})

	$(document).ready(function(){
		calculate()
	})

	$(document).on('click','#proses_pembelian', function(){
		var customer_id = $('#customer').val()
		var subtotal = $('#sub_total').val()
		var discount = $('#diskon').val()
		var grandtotal= $('#grand_total').val()
		var cash = $('#cash').val()
		var change = $('#change').val()
        var note = $('#note').val()
        var no_meja = $('#no_meja').val()
        var date = $('#date').val()

        if(subtotal < 1){
            alert('Belum Ada Produk Dipilih / Keranjang Kosong')
        }else if(cash < 1 || cash < grandtotal){
            alert('Jumlah Uang Belum Diinput atau Kurang dari Total Belanja')
            $('#cash').focus()
        }else{
            if(confirm('Yakin Proses Transaksi Ini ?')){
                $.ajax({
                    type :'POST',
                    url  : '<?= site_url('kasir/proses')?>',
                    data : {'proses_pembelian' : true, 'customer_id' : customer_id, 'subtotal' : subtotal, 'discount' : discount, 'grandtotal' : grandtotal, 'cash' : cash, 'change' : change, 'note' : note, 'date' : date, 'no_meja' : no_meja},
                    dataType : 'json',
                    success: function(result){
                        if(result.success == true){
                            alert('Transaksi Berhasil')
                            window.open('<?= site_url('kasir/cetak/')?>' + result.kasir_id, '_blank')
                        }else{
                            alert('Transaksi Gagal')
                        }
                        location.href='<?= site_url('kasir') ?>'
                    }
                })
            }
        }
	})

    $(document).on('click', '#batal_pembelian', function(){
        if(confirm('Apakah Anda Yakin Membatalkan Pesanan Ini ?')){
            $.ajax({
                type : 'POST',
                url  : '<?= site_url('kasir/cart_del')?>',
                data : {'batal_pembelian' : true},
                dataType : 'json',
                success: function(result){
                    if(result.success == true){
                        $('#cart-table').load('<?=site_url('kasir/cart_data')?>', function(){
                            calculate()
                        })
                    }
                }
            })
            $('#diskon').val(0)
            $('#cash').val(0)
            $('#customer').val('').change()
        }
    })

</script>
