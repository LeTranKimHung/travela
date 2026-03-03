<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CouponAdminController extends Controller
{
    public function __construct()
    {
        $this->ensureTablesExist();
    }

    private function ensureTablesExist()
    {
        if (!Schema::hasTable('tbl_coupons')) {
            Schema::create('tbl_coupons', function (Blueprint $table) {
                $table->id('couponId');
                $table->string('code', 50)->unique();
                $table->enum('type', ['percent', 'fixed'])->default('percent');
                $table->decimal('value', 10, 2);
                $table->decimal('min_order_value', 15, 2)->default(0);
                $table->integer('usage_limit')->nullable();
                $table->integer('used_count')->default(0);
                $table->timestamp('starts_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('tbl_booking')) {
            if (!Schema::hasColumn('tbl_booking', 'couponCode')) {
                Schema::table('tbl_booking', function (Blueprint $table) {
                    $table->string('couponCode', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('tbl_booking', 'discountAmount')) {
                Schema::table('tbl_booking', function (Blueprint $table) {
                    $table->decimal('discountAmount', 15, 2)->default(0);
                });
            }
        }
    }

    public function index()
    {
        $coupons = DB::table('tbl_coupons')->orderBy('couponId', 'desc')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:tbl_coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1'
        ]);

        DB::table('tbl_coupons')->insert([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'min_order_value' => $request->min_order_value ?? 0,
            'usage_limit' => $request->usage_limit,
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Thêm mã giảm giá thành công!');
    }

    public function edit($id)
    {
        $coupon = DB::table('tbl_coupons')->where('couponId', $id)->first();
        if (!$coupon) return redirect()->route('admin.coupons.index')->with('error', 'Mã không tồn tại!');
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:tbl_coupons,code,'.$id.',couponId',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1'
        ]);

        DB::table('tbl_coupons')->where('couponId', $id)->update([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'min_order_value' => $request->min_order_value ?? 0,
            'usage_limit' => $request->usage_limit,
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Cập nhật mã giảm giá thành công!');
    }

    public function destroy($id)
    {
        DB::table('tbl_coupons')->where('couponId', $id)->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Xóa mã giảm giá thành công!');
    }
}
