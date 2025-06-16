@extends('client.index')
@section('main')
<style>
  

.contact-container {
    max-width: 1170px;
    display: flex;
    flex-wrap: wrap;
    gap: 32px;
    margin-top: 20px;
    margin-left: 110px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    padding: 32px 24px;
}
.contact-info2 {
    display: flex;
    flex-direction: column;
    min-width: 320px;
    flex: 1; /* Thêm dòng này */
}

.contact-info2 h2, .contact-info2 h3 {
    margin-bottom: 12px;
    font-weight: bold;
    color: #2196F3;
}

.contact-info2 p {
    margin: 6px 0;
    font-size: 15px;
    color: #444;
}

.contact-info2 form {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-info2 input,
.contact-info2 textarea {
    margin-bottom: 0;
    padding: 12px;
    border: 1px solid #bbb;
    font-size: 15px;
    border-radius: 4px;
    background: #fafbfc;
    transition: border 0.2s;
}
.contact-info2 input:focus,
.contact-info2 textarea:focus {
    border: 1.5px solid #2196F3;
    outline: none;
    background: #fff;
}

.contact-info2 button {
    background-color: #2196F3;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.2s;
    box-shadow: 0 2px 8px rgba(33,150,243,0.08);
}
.contact-info2 button:hover {
    background-color: #1769aa;
}

.contact-map {
    flex: 1;
   width: 300px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

@media (max-width: 900px) {
    .contact-container {
        flex-direction: column;
        padding: 20px 8px;
    }
    .contact-map, .contact-info {
        min-width: 0;
    }
}
</style>


<div class="container-fluid py-4">
       <div class="container mb-3">
        <small class="breadcrumb" style="gap:4px">
            <a href="/">Trang chủ</a> <span>/</span> <span> liên hệ</span>
        </small>
    </div>



<div class="contact-container">
    <div class="contact-info2">
        <h2 style="font-size: 22px; font-weight: bold; margin-bottom: 12px; color: #222;">CÔNG TY CỔ PHẦN SƠN HẢI PHÒNG SỐ 2</h2>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Địa chỉ:</strong> Lô D1, Khu CN Tràng Duệ, An Dương, Hải Phòng</p>
        <p><i class="fas fa-phone"></i> <strong>Điện thoại:</strong> (+84) 225.3929.268</p>
        <p><span style="color: #d00; font-weight: bold;"><i class="fas fa-phone-volume"></i> Hotline: 096 209 1111</span></p>
        <p><i class="fas fa-fax"></i> <strong>Fax:</strong></p>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> info@selac.vn</p>
        <p><i class="fas fa-globe"></i> <strong>Website:</strong> <a href="http://selac.vn/" target="_blank">http://selac.vn/</a></p>
       
    </div>
    <div class="contact-map">
        <iframe src="..." width="450" height="400" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
    </div>
</div>

</div>
</div>
@endsection