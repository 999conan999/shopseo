var MERCHANT_ID = 12345678; // replace '12345678' with your Google Merchant Center ID
 
var SPREADSHEET_URL = ""; // insert spreadsheet url 
 
function main() {
 
  Logger.log("Fetching enabled feeds:\n")
  var fetchedFeeds = fetchEnabledProductFeeds(MERCHANT_ID);
 
  reportResults(fetchedFeeds);
}
 
 
function reportResults(fetchedFeeds) {
 
  //prepare the Spreadsheet
  var ss = SpreadsheetApp.openByUrl(SPREADSHEET_URL);
  var sheet = ss.getActiveSheet();
  sheet.clear();
   
  var header = [
    "Date, Time",
    "Feed Name", 
    "Feed ID", 
    "Status"
  ];
   
  if (sheet.getRange('A1').isBlank()) {
    sheet.appendRow(header); 
    Logger.log("Added header to sheet");
  }
 
  var lastRow = sheet.getLastRow();
 
  // write status to sheet
  var range = sheet.getRange(lastRow+1, 1, fetchedFeeds.length, header.length);
  range.setValues(fetchedFeeds);
  Logger.log("Added results to sheet : "+SPREADSHEET_URL)
}
 
 
function fetchEnabledProductFeeds(merchantId) {
   
  var fetchedFeeds = [];
   
  var date = new Date();
  var now = Utilities.formatDate(date, AdsApp.currentAccount().getTimeZone(), "yyyy MMM dd, HH:mm");
  Logger.log("The current time (timezone of the account) is: "+ now);
   
  var productFeeds = ShoppingContent.Datafeeds.list(merchantId);
   
  if (productFeeds.resources) {
     
    for (var i = 0; i < productFeeds.resources.length; i++) {
       
      if(productFeeds.resources[i].fetchSchedule.paused==false) {
        try {
          var dataFeedId = productFeeds.resources[i].id;          
          var response = ShoppingContent.Datafeeds.fetchnow(merchantId, dataFeedId);
          Logger.log ("Response: "+response);
          Logger.log("Fetched productfeed: '"+productFeeds.resources[i].name+"' with id: '"+dataFeedId+"'");
          fetchedFeeds.push([now, productFeeds.resources[i].name, dataFeedId, "Fetch OK"]);
        } catch(e) {
          Logger.log("### ERROR Fecthing datafeed: '"+productFeeds.resources[i].name+"' with id: '"+dataFeedId+"' with fetchUrl: '"+productFeeds.resources[i].fetchSchedule.fetchUrl+"' --> "+e);
          fetchedFeeds.push([now, productFeeds.resources[i].name, dataFeedId, "### ERROR Fecthing datafeed: "+e]);
        }
      }
    }
  }
  return fetchedFeeds;
}
