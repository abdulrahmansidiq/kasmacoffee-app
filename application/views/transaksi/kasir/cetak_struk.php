<html moznomarginbox mozdisallowselectionprint>

<head>
    <title>Struk MM Coffee</title>
    <style type="text/css">
        html {
            font-family: "Verdana, Arial";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <?php if (!empty($this->fungsi->get_setting()->logo)): ?>
                <img src="<?= base_url('uploads/'.$this->fungsi->get_setting()->logo) ?>" alt="Logo" style="height: 50px; margin-bottom: 5px;">
                <br>
            <?php endif; ?>
            <b><?= $this->fungsi->get_setting()->nama_usaha ?></b>
            <br>
            <?= $this->fungsi->get_setting()->alamat ?>
            <?php if (!empty($this->fungsi->get_setting()->telepon)): ?>
                <br>Telp/WA: <?= $this->fungsi->get_setting()->telepon ?>
            <?php endif; ?>
        </div>

        <div class="head">
            <table cellspacing="0" cellpading="0">
                <tr>
                    <td style="width:200px">
                        <?php
                        echo Date("d/m/Y", strtotime($kasir->date)) . " " . Date("H:i", strtotime($kasir->kasir_created));
                        ?>
                    </td>
                    <td>Kasir</td>
                    <td style="text-align:center;width:10px;">:</td>
                    <td style="text-align:right">
                        <?= ucfirst($kasir->user_name) ?>
                    </td>
                </tr>
                <tr>
                    <td><?= $kasir->invoice ?></td>
                    <td>Customer</td>
                    <td style="text-align:center">:</td>
                    <td style="text-align:right">
                        <?= $kasir->customer_name ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpading="0">
                <?php
                $arr_discount = array();
                foreach ($kasir_detail as $key => $value) { ?>
                    <tr>
                        <td valign="top" style="width:165px;"><?= $value->name ?></td>
                        <td valign="top"><?= $value->qty ?></td>
                        <td valign="top" style="text-align:right;width:60px;"><?= indo_currency($value->price) ?></td>
                        <td valign="top" style="text-align:right;width:60px;">
                            <?= indo_currency(($value->price - $value->discount_item) * $value->qty) ?>
                        </td>
                    </tr>

                    <?php
                    if ($value->discount_item > 0) {
                        $arr_discount[] = $value->discount_item;
                    }
                }

                foreach ($arr_discount as $key => $value) { ?>
                    <tr>
                        <td></td>
                        <td valign="top" colspan="2" style="text-align:right">Disc. <?= $key + 1 ?></td>
                        <td style="text-align:right"><?= indo_currency($value) ?></td>
                    </tr>
                <?php
                } ?>

                <tr{>
                    <td colspan="4" style="border-bottom:1px dashed; padding-top:5px"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td valign="top" style="text-align:right; padding-top:5px">Sub Total</td>
                        <td style="text-align:right; padding-top:5px">
                            <?= indo_currency($kasir->total_price) ?>
                        </td>
                    </tr>
                    <?php if ($kasir->discount > 0) { ?>
                        <tr>
                            <td colspan="2"></td>
                            <td valign="top" style="text-align:right; padding-top:5px">Disc. Kasir</td>
                            <td style="text-align:right; padding-top:5px">
                                <?= indo_currency($kasir->discount) ?>
                            </td>
                        </tr>
                    <?php
                    } ?>
                    <tr>
                        <td colspan="2"></td>
                        <td valign="top" style="border-top:1px dashed; text-align:right; padding:5px 0">Grand Total</td>
                        <td style="border-top:1px dashed; text-align:right; padding:5px 0">
                            <?= indo_currency($kasir->final_price) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td valign="top" style="border-top:1px dashed; text-align:right; padding:5px">Cash</td>
                        <td style="border-top:1px dashed; text-align:right;"><?= indo_currency($kasir->cash) ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td valign="top" style="text-align:right">Kembalian</td>
                        <td style="text-align:right"><?= indo_currency($kasir->remaining) ?></td>
                    </tr>
            </table>
        </div>
        <div class="thanks">
            Meja : <?= $kasir->no_meja ?>
        </div>
        <div class="thanks">
            ~~~ Terima Kasih ~~~
            <br>
            <?= $this->fungsi->get_setting()->nama_usaha ?>
        </div>
    </div>
</body>

</html>