package com.example.laundry;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DatabaseHelper extends SQLiteOpenHelper {

    public static final String DATABASE_NAME = "laundry.db";
    public static final String TABLE_NAME = "tabel_transaksi";
    public static final String COL_1 = "id";
    public static final String COL_2 = "nama_pelanggan";
    public static final String COL_3 = "jns_paket";
    public static final String COL_4 = "jsn_layanan";
    public static final String COL_5 = "jumlah";
    public static final String COL_6 = "tgl_selesai";
    public static final String COL_7 = "harga";

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, 2);
    }



    @Override public void onCreate(SQLiteDatabase db2) {
        db2.execSQL("create table " + TABLE_NAME +" (id TEXT PRIMARY KEY,nama_pelanggan TEXT,jns_paket TEXT,jns_layanan TEXT,jumlah INTEGER,tgl_selesai TEXT,harga INTEGER)");
    }


    @Override
    public void onUpgrade(SQLiteDatabase db2, int oldVersion, int newVersion) {
        db2.execSQL("DROP TABLE IF EXISTS "+TABLE_NAME);
        onCreate(db2);
    }


    public boolean insertData(String id,String nama_pelanggan,String jns_paket,String jns_layanan, int jumlah, String tgl_selesai, int harga) {
        SQLiteDatabase db2 = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_1,id);
        contentValues.put(COL_2,nama_pelanggan);
        contentValues.put(COL_3,jns_paket);
        contentValues.put(COL_4,jns_layanan);
        contentValues.put(COL_5,jumlah);
        contentValues.put(COL_6,tgl_selesai);
        contentValues.put(COL_7,harga);
        long result = db2.insert(TABLE_NAME,null ,contentValues);
        if(result == -1)
            return false;
        else
            return true;
    }


    public boolean updateData(String id,String nama_pelanggan,String jns_paket,String jns_layanan, int jumlah, String tgl_selesai, int harga) {
        SQLiteDatabase db2 = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_1,id);
        contentValues.put(COL_2,nama_pelanggan);
        contentValues.put(COL_3,jns_paket);
        contentValues.put(COL_4,jns_layanan);
        contentValues.put(COL_5,jumlah);
        contentValues.put(COL_6,tgl_selesai);
        contentValues.put(COL_7,harga);
        int result = db2.update(TABLE_NAME, contentValues, "id = ?",new String[] { id });
        if(result == -1)
            return false;
        else
            return true;
    }


    public boolean deleteData(String id) {
        SQLiteDatabase db = this.getWritableDatabase();
        int result = db.delete(TABLE_NAME,"id = ?" ,new String[] { id });
        if(result == 0)
            return false;
        else
            return true;
    }


    public Cursor getAllData() {
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor res = db.rawQuery("select * from "+TABLE_NAME,null);
        return res;
    }





}
