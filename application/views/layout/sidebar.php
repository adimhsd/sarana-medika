<div class="leftpanel">
    <div class="leftmenu">        
        <ul class="nav nav-tabs nav-stacked">
            <li <?php if(isset($dashboard)) echo $dashboard;?>><?=anchor('dashboard', '<span class="iconfa-home"></span> Dashboard');?></li>

            <?php if ($this->session->userdata('jabatan') == 'owner') {?>
                <li <?php if(isset($barang)) echo $barang;?>><?=anchor('barang/laporan', '<span class="iconfa-signout"></span> Barang');?></li>
                <li <?php if(isset($pegawai)) echo $pegawai;?>><?=anchor('pegawai/laporan', '<span class="iconfa-signout"></span> Pegawai');?></li>
                <li <?php if(isset($supplier)) echo $supplier;?>><?=anchor('supplier/laporan', '<span class="iconfa-signout"></span> Supplier');?></li>
                <li <?php if(isset($customer)) echo $customer;?>><?=anchor('customer/laporan', '<span class="iconfa-signout"></span> Customer');?></li>
                <li <?php if(isset($lap_penjualan)) echo $lap_penjualan;?>><?=anchor('penjualan/lap_bulanan', '<span class="iconfa-signout"></span> Laporan Penjualan');?></li>
                <li <?php if(isset($lap_pembelian)) echo $lap_pembelian;?>><?=anchor('pembelian/lap_bulanan', '<span class="iconfa-signout"></span> Laporan Pembelian');?></li>

            <?php } else if ($this->session->userdata('jabatan') == 'administrator') { ?>
                <li <?php if(isset($pegawai)) echo $pegawai;?>><?=anchor('pegawai', '<span class="iconfa-signout"></span> Pegawai');?></li>
                <li <?php if(isset($barang)) echo $barang;?>><?=anchor('barang', '<span class="iconfa-signout"></span> Barang');?></li>
                <li <?php if(isset($supplier)) echo $supplier;?>><?=anchor('supplier', '<span class="iconfa-signout"></span> Supplier');?></li>
                <li <?php if(isset($customer)) echo $customer;?>><?=anchor('customer', '<span class="iconfa-signout"></span> Customer');?></li>
                <li <?php if(isset($pembelian)) echo $pembelian;?>><?=anchor('pembelian', '<span class="iconfa-signout"></span> Pembelian');?></li>
                <li <?php if(isset($penjualan)) echo $penjualan;?>><?=anchor('penjualan', '<span class="iconfa-signout"></span> Penjualan');?></li>
                <li <?php if(isset($lap_penjualan)) echo $lap_penjualan;?>><?=anchor('penjualan/lap_bulanan', '<span class="iconfa-signout"></span> Laporan Penjualan');?></li>
                <li <?php if(isset($lap_pembelian)) echo $lap_pembelian;?>><?=anchor('pembelian/lap_bulanan', '<span class="iconfa-signout"></span> Laporan Pembelian');?></li>

            <?php } else if ($this->session->userdata('jabatan') == 'gudang') { ?>
                <li <?php if(isset($barang)) echo $barang;?>><?=anchor('barang', '<span class="iconfa-signout"></span> Barang');?></li>
                <li <?php if(isset($supplier)) echo $supplier;?>><?=anchor('supplier', '<span class="iconfa-signout"></span> Suplier');?></li>
                <li <?php if(isset($pembelian)) echo $pembelian;?>><?=anchor('pembelian', '<span class="iconfa-signout"></span> Pembelian');?></li>
                <li <?php if(isset($lap_pembelian)) echo $lap_pembelian;?>><?=anchor('pembelian/lap_bulanan', '<span class="iconfa-signout"></span> Laporan Pembelian');?></li>

            <?php } else if ($this->session->userdata('jabatan') == 'kurir') { ?>
                <li <?php if(isset($penjualan)) echo $penjualan;?>><?=anchor('penjualan/kurir', '<span class="iconfa-signout"></span> Penjualan');?></li>
            <?php } else if ($this->session->userdata('jabatan') == 'marketing') { ?>
                <li <?php if(isset($customer)) echo $customer;?>><?=anchor('customer', '<span class="iconfa-signout"></span> Customer');?></li>
                <li <?php if(isset($penjualan)) echo $penjualan;?>><?=anchor('penjualan', '<span class="iconfa-signout"></span> Penjualan');?></li>
                <li <?php if(isset($lap_penjualan)) echo $lap_penjualan;?>><?=anchor('penjualan/lap_bulanan', '<span class="iconfa-signout"></span> Laporan Penjualan');?></li>
            <?php } ?>            
        </ul>
    </div> 
</div>