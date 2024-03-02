<style>
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>
<div class="card gradient-meridian">
    <div class="card-body">
        <h4 class="card-title" style="color: rgb(255, 255, 255);">{{ $data->nama_cabang }}</h4>
        <h6 style="color: rgb(240, 186, 186);">Tiket Ini Harap Disimpan Agar Bisa di Approve dengan yang pembuat laporan</h6>
        <p style="color: rgb(255, 255, 255);">{{ $data->alamat }}</p>
        <hr>
        <span class="badge badge-success m-1" >{{ $tiket }}</span> <button class="btn-dark btn-sm"
            onclick="copytext();" onmouseout="outFunc()" id="myTooltip"><span class="tooltiptext" ></span>
            Copy</button>
        <input type="text" name="kd_cabang" value="{{ $data->kd_cabang }}" hidden>
        <input type="text" name="tiket" value="{{ $tiket }}" id="tiket_order" hidden>
    </div>
</div>
