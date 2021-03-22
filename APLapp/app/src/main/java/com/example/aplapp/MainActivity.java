package com.example.aplapp;

import androidx.appcompat.app.AppCompatActivity;
import androidx.collection.ArraySet;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.io.BufferedOutputStream;
import java.io.BufferedWriter;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class MainActivity extends AppCompatActivity {
    EditText username;
    EditText password;
    Button loginButton;
    TextView text;
    String gg;
    //private ArraySet<StringRequest> queue;

    int i=0;
    String urf = "http://10.0.2.2:8080/t4/bull/kalender/APL/period/period.php?submit=1&username=userföretag&password=lodenord";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

            setContentView(R.layout.activity_main);

        text = (TextView) findViewById(R.id.text);
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        loginButton = (Button) findViewById(R.id.button);


        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String pass = password.getText().toString();
                final String use = username.getText().toString();
                String ugb = urf.replace("userföretag", use);
                String uff = ugb.replace("lodenord", pass);

                ecec(uff);


            }
        });
    }
    private void ecec(String url) {
// Request a string response from the provided URL.
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // Display the first 500 characters of the response string.
                        text.setText("Response is: " + response);

                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                text.setText("That didn't work!");
            }
        });

// Add the request to the RequestQueue
        queue.add(stringRequest);

    }



}
