<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Anggaran;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Rules\Unique;

class MobileController extends Controller
{
    public function login(Request $request)
    {
        $email = strip_tags($request->input('email'));
        $password = strip_tags($request->input('password'));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'Login gagal, silahkan periksa kembali username dan password anda',
            ]);
        }
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $user = Auth::user();
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Berhasil',
                    'data' => $user,
                ]);
                // return redirect()->intended('/');
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Login Gagal, Silahkan Perikasa kembali username dan password anda',
                ]);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Sepertinya terjadi Kesalahan',
            ]);
        }
    }
    public function ceklogin(){
        if(Auth::check()){
            return response()->json([
                'status' => 200,
                'message' => 'User Login',
                'data' => Auth::user()
            ],);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }
    }
    public function register(Request $request)
    {
        $name = $request->input('name');
        // $username = $request->input('username');
        $email = $request->input('email');
        $telehphone = $request->input('no_hp');
        $password = $request->input('password');

        // $this->validate($request, [
        //     'name' => 'required|min:4',
        //     'email' => 'required|email|unique:users,email',
        //     'username' => 'required|unique:users,username',
        //     'no_hp' => 'required|numeric',
        //     'password' => 'required|min:8',
        // ]);

        $cekEmail = User::where('email', $email)->first();
        if ($cekEmail) {
            return response()->json([
                'status' => 400,
                'message' => 'Email Sudah digunakan'
            ],);
        }
        $cekname = User::where('name', $name)->first();
        if ($cekname) {
            return response()->json([
                'status' => 400,
                'message' => 'Username Sudah digunakan'
            ],);
        }

        $no_hp = User::where('no_hp', $telehphone)->first();
        if ($no_hp) {
            return response()->json([
                'status' => 400,
                'message' => 'Nomor Sudah digunakan Sudah digunakan'
            ],);
        }
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'no_hp' => $telehphone,
            'password' => Hash::make($password),
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Registrasi Berhasil'
        ],);
    }
     // api logout
     public function logout(Request $request)
     {
         $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
 
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
             Auth::logout();
             return response()->json([
                 'status' => 200,
                 'message' => 'Berhasil Logout',
             ]);
         } else {
             $data = [
                 'status' => 400,
                 'message' => 'Token Salah',
             ];
             return response()->json(['data' => $data]);
         }
     }

     public function indexKategori(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
 
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
         $kategori = Kategori::orderBy('id','DESC')->get();
         return response()->json([
            'status' => 200,
            'message' => 'berhasil',
            'kategori' => $kategori],);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }
     public function indexAnggaran(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
 
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
         $pemasukan = Pemasukan::orderBy('id','DESC')->where('user_id',Auth::id())->get();
         $anggaran = Anggaran::orderBy('id','DESC')->where('user_id',Auth::id())->get();

         $totalAnggaran =  $pemasukan->sum('pemasukan');
         $totalPengeluaran = $anggaran->sum('anggaran');
         $totalSisa = $totalAnggaran - $totalPengeluaran;

         return response()->json([
            'status' => 200,
            'message' => 'berhasil',
            'total_anggaran' =>$totalAnggaran,
            'anggaran_pengeluaran' => $totalPengeluaran,
            'sisa'=> $totalSisa,
            'anggaran' => $anggaran],);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }
     public function createAnggaran(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         $pemasukan_id = $request->input('pemasukan_id');
         $kategori_id = $request->input('kategori_id');
         $tanggal = $request->input('tanggal');
         $anggaran = $request->input('anggaran');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
            Anggaran::create([
                'pemasukan_id'=> $pemasukan_id,
                'kategori_id'=> $kategori_id,
                'tanggal' => $tanggal,
                'anggaran' => $anggaran,
                'user_id' => auth()->id(),
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Menambah Anggaran',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }
     public function editAnggaran(Request $request, $id)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         
         $pemasukan_id = $request->input('pemasukan_id');
         $kategori_id = $request->input('kategori_id');
         $tanggal = $request->input('tanggal');
         $anggaran = $request->input('anggaran');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
           $data = Anggaran::find($id);
           if (!$data) {
            return response()->json([
                'status' => 400,
                'message' => 'Data Tidak Ditemukan'
            ],);
        }
            $data->update([
                'pemasukan_id'=> $pemasukan_id,
                'kategori_id'=> $kategori_id,
                'tanggal' => $tanggal,
                'anggaran' => $anggaran,
                'user_id' => auth()->id(),
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Update Anggaran',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }
    public function deleteAnggaran(Request $request, $id)
    {
       $token = 'e957533851fc66fea69171d6275f3a7c';
        $headerValue = $request->header('token');
        
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
          $data = Anggaran::find($id);
          if (!$data) {
           return response()->json([
               'status' => 400,
               'message' => 'Data Tidak Ditemukan'
           ],);
       }
           $data->delete();
           return response()->json([
               'status' => 200,
           'message' => 'Berhasil Menghapus Anggaran',]);
       } else {
           $data = [
               'status' => 400,
               'message' => 'Token Salah',
           ];
           return response()->json(['data' => $data]);
       }
   }

   public function indexPemasukan(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
 
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
         
         if ($headerValue == $token) {
            $pemasukan = Pemasukan::orderBy('id','DESC')->where('user_id',Auth::id())->get();
            $totalPemasukan =  $pemasukan->sum('pemasukan');
         return response()->json([
            'status' => 200,
            'message' => 'berhasil',
            'total_saldo' => $totalPemasukan,
            'pemasukan' => $pemasukan],);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }
     public function createPemasukan(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         $pemasukan = $request->input('pemasukan');
         $catatan = $request->input('catatan');
         $tanggal = $request->input('tanggal');
         $jam = $request->input('jam');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
            Pemasukan::create([
                'user_id' => auth()->id(),
                'pemasukan' => $pemasukan,
                'catatan' => $catatan,
                'tanggal' => $tanggal,
                'jam' => $jam
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Menambah pemasukan',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }

     public function editPemasukan(Request $request, $id)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         
         $pemasukan = $request->input('pemasukan');
         $catatan = $request->input('catatan');
         $tanggal = $request->input('tanggal');
         $jam = $request->input('jam');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
           $data = Pemasukan::find($id);
           if (!$data) {
            return response()->json([
                'status' => 400,
                'message' => 'Data Tidak Ditemukan'
            ],);
        }
            $data->update([
                'user_id' => auth()->id(),
                'pemasukan' => $pemasukan,
                'catatan' => $catatan,
                'tanggal' => $tanggal,
                'jam' => $jam
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Update Pemasukan',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    public function deletePemasukan(Request $request, $id)
    {
       $token = 'e957533851fc66fea69171d6275f3a7c';
        $headerValue = $request->header('token');
        
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
          $data = Pemasukan::find($id);
          if (!$data) {
           return response()->json([
               'status' => 400,
               'message' => 'Data Tidak Ditemukan'
           ],);
       }
           $data->delete();
           return response()->json([
               'status' => 200,
           'message' => 'Berhasil Menghapus Pemasukan',]);
       } else {
           $data = [
               'status' => 400,
               'message' => 'Token Salah',
           ];
           return response()->json(['data' => $data]);
       }
   }
   public function userAktif(Request $request)
   {
       $token = '$2y$10$t1VPjggRmzmy9O7obgOvceAf';
       $headerValue = $request->header('token');

       $user = auth()->user();
       if (!$user) {
           return response()->json([
               'status' => 400,
               'message' => 'User is not logged in'
           ],);
       }

       if ($headerValue == $token) {
           $user = User::find(Auth::id());
           $result[] = [
               'id' => $user->id,
               'nama' => $user->name,
            //    'username' => $user->username,
               'email' => $user->email,
               'no_hp' => $user->no_hp,
           ];

           return response()->json([
               'status' => 200,
               'message' => 'success',
               'data' => $result
           ]);
       } else {
           $data = [
               'status' => 400,
               'message' => 'Token Salah',
           ];
           return response()->json(['data' => $data]);
       }
   }

   public function indexPengeluaran(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
 
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
            $pengeluaran = Pengeluaran::orderBy('id','DESC')->where('user_id',Auth::id())->get();
   
            $totalPengeluaran =  $pengeluaran->sum('pengeluaran');
         return response()->json([
            'status' => 200,
            'message' => 'berhasil',
            'total_pengeluaran' => $totalPengeluaran,
            'pengeluaran' => $pengeluaran],);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }

     public function createPengeluaran(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         $kategori_id = $request->input('kategori_id');
         $pemasukan_id = $request->input('pemasukan_id');
         $pengeluaran = $request->input('pengeluaran');
         $catatan = $request->input('catatan');
         $tanggal = $request->input('tanggal');
         $jam = $request->input('jam');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
            Pengeluaran::create([
                'user_id' => auth()->id(),
                'kategori_id' => $kategori_id,
                'pemasukan_id' => $pemasukan_id,
                'pengeluaran' => $pengeluaran,
                'catatan' => $catatan,
                'tanggal' => $tanggal,
                'jam' => $jam
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Menambah pemasukan',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }

     public function editPengeluaran(Request $request, $id)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         
         $kategori_id = $request->input('kategori_id');
         $pemasukan_id = $request->input('pemasukan_id');
         $pengeluaran = $request->input('pengeluaran');
         $catatan = $request->input('catatan');
         $tanggal = $request->input('tanggal');
         $jam = $request->input('jam');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
           $data = Pengeluaran::find($id);
           if (!$data) {
            return response()->json([
                'status' => 400,
                'message' => 'Data Tidak Ditemukan'
            ],);
        }
            $data->update([
                'user_id' => auth()->id(),
                'kategori_id' => $kategori_id,
                'pemasukan_id' => $pemasukan_id,
                'pengeluaran' => $pengeluaran,
                'catatan' => $catatan,
                'tanggal' => $tanggal,
                'jam' => $jam
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Update Pengeluaran',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    public function deletePengeluaran(Request $request, $id)
    {
       $token = 'e957533851fc66fea69171d6275f3a7c';
        $headerValue = $request->header('token');
        
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
          $data = Pengeluaran::find($id);
          if (!$data) {
           return response()->json([
               'status' => 400,
               'message' => 'Data Tidak Ditemukan'
           ],);
       }
           $data->delete();
           return response()->json([
               'status' => 200,
           'message' => 'Berhasil Menghapus Pengeluaran',]);
       } else {
           $data = [
               'status' => 400,
               'message' => 'Token Salah',
           ];
           return response()->json(['data' => $data]);
       }
   }
   public function indexTabungan(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
 
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
         $tabungan = Tabungan::orderBy('id','DESC')->get();
         return response()->json([
            'status' => 200,
            'message' => 'berhasil',
            'tabungan' => $tabungan],);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }

     public function createTabungan(Request $request)
     {
        $token = 'e957533851fc66fea69171d6275f3a7c';
         $headerValue = $request->header('token');
         //input variable
         $nama = $request->input('nama');
         $anggaran = $request->input('anggaran');
         $sistem = $request->input('sistem');
         $periodeMulai = $request->input('periodeMulai');
         $periodeSelesai = $request->input('periodeSelesai');
         $user = auth()->user();
         if (!$user) {
             return response()->json([
                 'status' => 400,
                 'message' => 'User is not logged in'
             ],);
         }
 
         if ($headerValue == $token) {
            Tabungan::create([
                'user_id' => auth()->id(),
                'nama' => $nama,
                'anggaran' => $anggaran,
                'sistem' => $sistem,
                'periodeMulai' => $periodeMulai,
                'periodeSelesai' => $periodeSelesai,
            ]);
            return response()->json([
                'status' => 200,
            'message' => 'Berhasil Menambah pemasukan',]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
     }

}
