var dateTimeFormat = {
    monthFullName: [],
    monthShortName: [],
    format: null,
    now: {},
    initialize: function(format) {
        if (format) {
            this.format = format;
        }
        this.now = new Date();
        this.monthFullName = ["January", "February", "March",
            "April", "May", "June", "July", "August", "September",
            "October", "November", "December"];
        this.monthShortName = ["Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul", "Aug", "Sep",
            "Oct", "Nov", "Dec"];
    },
    getDayString: function(day) {
        switch (day) {
            case "2" :
                return day + "nd ";
            case "3" :
                return day + "rd ";
            default :
                return day + "th ";
        }
    },
    getDate: function() {
        var year = this.now.getFullYear();
        var month = this.now.getMonth() + 1;
        var day = this.now.getDate();
        var date;
        switch (this.format) {
            case "short" :
                date = this.getDayString(day) + this.monthShortName[month - 1] + ', ' + year;
                break;
            case "long" :
                date = this.getDayString(day) + this.monthFullName[month - 1] + ', ' + year;
                break;
            default :
                month = (month.toString().length === 1) ? ('0' + month) : month;
                day = (day.toString().length === 1) ? ('0' + day) : day;
                date = year + '-' + month + '-' + day;
                break;
        }
        return date;
    },
    getTime: function() {
        var hour = this.now.getHours();
        var minute = this.now.getMinutes();
        var second = this.now.getSeconds();
        var time;
        switch (this.format) {
            case "short" :
                time = hour + ':' + minute;
                break;
            case "long" :
                time = hour + ':' + minute + ':' + second;
                break;
        }
        return time;
    },
    getDateTime: function() {
        var dateTime = this.getDate() + " " + this.getTime();
        return dateTime;
    }
}

module.exports = dateTimeFormat;