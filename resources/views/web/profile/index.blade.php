@extends('web.index')
@section('title','Thông tin tài khoản')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content box-profile">
        <div class="menu-profile">
            <a href="{{route('profile')}}" class="menu-item-profile menu-profile-active"><i class="fa-regular fa-user"></i> Thông tin cá nhân</a>
            <a href="{{route('order')}}" class="menu-item-profile"><i class="fa-regular fa-clipboard"></i> Quản lý đơn hàng</a>
            <a href="{{url('lich-su-giao-dich/vi')}}" class="menu-item-profile"><i class="fa-regular fa-credit-card"></i> Tài khoản trả trước</a>
            <a href="{{route('logout')}}" class="menu-item-profile"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a>
        </div>
        <div class="content-profile">
            <div class="position-relative">
                <img src="{{asset('assets/images/banner_profile_user.png')}}" class="w-100">
                <div class="box-avatar">
                    @if($data->avatar)
                        <img src="{{asset($data->avatar)}}" alt="" id="avatar-preview">
                    @else
                        <img src="{{asset('assets/images/icon-avatar-user.svg')}}" alt="" id="avatar-preview">
                    @endif
                    <div class="camera-icon" id="change-avatar">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                <input type="file" id="avatar-input" hidden accept="image/*">
            </div>
            <div class="content-info-profile">
                <p class="name-user">{{@$data->full_name}}</p>
                <div class="edit-info" data-bs-toggle="modal" data-bs-target="#staticEditUser">Chỉnh sửa thông tin <i class="fa-regular fa-pen-to-square"></i></div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Tên đăng nhập:</span>
                    <span class="name-info-user">{{@$data->username}}</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Email:</span>
                    <span class="name-info-user">{{@$data->email}}</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Số điện thoại:</span>
                    <span class="name-info-user">{{@$data->phone}}</span>
                </div>
                <div class="line-profile"></div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Ngày sinh:</span>
                    <span class="name-info-user">{{ \Carbon\Carbon::parse(@$data->date_of_birth)->format('d/m/Y') }}</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Giới tính:</span>
                    <span class="name-info-user">@if($data->gender == 1) Nam @else Nữ @endif</span>
                </div>
            </div>

        </div>


    </div>
    <!-- Modal edit user-->
    <div class="modal fade" id="staticEditUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticEditUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticEditUserLabel">Chỉnh Sửa Thông Tin Cá Nhân</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('save-profile') }}" method="POST">
                    @csrf
                <div class="modal-body pt-0">
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Họ và tên </span>
                        <input type="text" class="input-form-address" name="full_name" placeholder="Họ và tên" value="{{@$data->full_name}}" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Tên đăng nhập</span>
                        <input type="text" class="input-form-address" placeholder="Tên đăng nhập" value="{{@$data->username}}" disabled>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Email</span>
                        <input type="text" class="input-form-address" placeholder="Email" value="{{@$data->email}}" disabled>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Số điện thoại</span>
                        <input type="text" class="input-form-address" placeholder="Số điện thoại" value="{{@$data->phone}}" disabled>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Ngày sinh</span>
                        <input type="date" class="input-form-address" name="date_of_birth" value="{{@$data->date_of_birth}}" placeholder="Ngày sinh" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Giới tính</span>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center ">
                                <input type="radio" id="nam" name="gender" value="1" @if($data->gender == 1) checked @endif>
                                <label for="nam" style="font-size: 12px;margin-left: 3px">Nam</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="radio" id="nu" name="gender" value="2" @if($data->gender == 2) checked @endif >
                                <label for="nu" style="font-size: 12px;margin-left: 3px">Nữ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-dismiss-address" data-bs-dismiss="modal">Hủy Bỏ</button>
                    <button type="submit" class="btn btn-primary btn-success-address">Xác Nhận</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('script_page')
    <script>
        document.getElementById('change-avatar').addEventListener('click', function() {
            document.getElementById('avatar-input').click();
        });

        document.getElementById('avatar-input').addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                };

                reader.readAsDataURL(event.target.files[0]);

                var formData = new FormData();
                formData.append('avatar', event.target.files[0]);

                $.ajax({
                    url: '{{ route("change-avatar") }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.msg);
                        } else {
                            alert('Đã xảy ra lỗi khi upload ảnh.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi trong quá trình upload.');
                    }
                });
            }
        });

    </script>
@stop
