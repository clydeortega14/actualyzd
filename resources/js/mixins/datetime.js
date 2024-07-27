import moment from "moment";

export default {
    methods: {
        wholeDate(date) {
            return moment(date).format("dddd, MMMM Do YYYY");
        },
        wholeTime(time) {
            return moment(time, "HH:mm:ss").format("LT");
        },
        monthsOfTheYear() {
            return Array.apply(0, Array(12)).map(function (_, i) {
                return `${moment().year()} - ${moment().month(i).format("MMM")}`;
            });
        },
        dateAndTimeFormat(date, time_from, time_to) {
            let date_format = this.wholeDate(date);
            let time_form_format = this.wholeTime(time_from);
            let time_to_format = this.wholeTime(time_to);
            return `${date_format} @ ${time_form_format} - ${time_to_format}`;
        },
    },
};
