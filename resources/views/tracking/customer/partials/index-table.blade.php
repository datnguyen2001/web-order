<style>
    #customerTableWrapper {
        overflow-x: auto; /* Enable horizontal scrolling */
    }
    #customerTable {
        width: 100%; /* Ensure the table takes up the full width of its container */
    }
    #customerTable tr th,
    #customerTable tr td {
        white-space: nowrap; /* Prevent wrapping in cells */
    }
</style>

<div class="card-body">
    <div id="customerTableWrapper">
        <table id="customerTable" class="table table-hover align-middle mb-0">
            <thead>
            <tr>
                <th>Id</th>
                <th>Họ và Tên</th>
                <th>Username</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($customers) && count($customers) > 0)
                @foreach($customers as $index => $customer)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$customer->full_name ?? 'N/A'}}</td>
                        <td>{{$customer->username ?? 'N/A'}}</td>
                        <td>{{$customer->phone ?? 'N/A'}}</td>
                        <td>{{$customer->email ?? 'N/A'}}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.tracking.customer.edit', [$customer->id]) }}" class="mr-1">
                                <i class="icofont-pen-alt-1 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Customer"></i>
                            </a>
                            <form action="{{ route('admin.tracking.customer.destroy', [$customer->id]) }}" method="POST" onsubmit="return confirm('Bạn Có Muốn Xoá Khách Hàng Này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-0" title="Delete Customer" style="background: none">
                                    <i class="icofont-ui-delete text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">Không Tìm Thấy Khách Hàng</td>
                </tr>
            @endif
            </tbody>
        </table>
        @if (!empty($customers) && $customers->total() > ($request['per_page'] ?? 10))
            <div class="d-flex justify-content-center mt-3">
                {{ $customers->appends(request()->all())->links('admin.pagination_custom.index') }}
            </div>
        @endif
    </div>
</div>
