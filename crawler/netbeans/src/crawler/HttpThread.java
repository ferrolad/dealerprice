/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package crawler;

import java.net.CookieHandler;
import java.net.CookieManager;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;


/**
 *
 * @author Boney
 */
public class HttpThread implements Runnable {
   private Thread t;
   private final String productDetailsId, productId;
   private final String affiliateUrl;
   private final MySQLAccess dao;
   private final ApiCall api;
   
   HttpThread( String id, String pid, String url, MySQLAccess obj){
       productDetailsId = id;
       productId = pid;
       affiliateUrl = url;
       dao = obj;
       api = new ApiCall(id, pid, obj);
   }

   @Override
   public void run() {
      //System.out.println("Running " +  productDetailsId +" "+affiliateUrl +" "+Thread.currentThread().getId() );
      Document doc;
       try {
              // make sure cookies is turn on
              CookieHandler.setDefault(new CookieManager());
              HttpCClient http = new HttpCClient();
              String page = http.GetPageContent(affiliateUrl);
              doc = Jsoup.parse(page);

            if(affiliateUrl.contains("flipkart"))
              api.flipkart(doc);
            if(affiliateUrl.contains("amazon"))
              api.amazon(doc);
            if(affiliateUrl.contains("snapdeal"))
              api.snapdeal(doc);
            if(affiliateUrl.contains("infibeam"))
              api.infibeam(doc);

       } catch (Exception ex) {
           Logger.getLogger(HttpThread.class.getName()).log(Level.SEVERE, null, ex);
       }
   }
   
  /* public void start ()
   {
      if (t == null)
      {
         t = new Thread (this, productDetailsId);
         t.start ();
      }
   }*/

}

