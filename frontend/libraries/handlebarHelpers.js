/**
 * Customised if conditions
 *
 */
Handlebars = require('handlebars');
$(document).ready(function() {
    alert('tested');
    Handlebars.registerHelper("condition", condition);
});
function condition(var1, operator, var2, options) {
    switch (operator)
    {
        case "==":
            return (var1 == var2) ? options.fn(this) : options.inverse(this);
        case "!=":
            return (var1 != var2) ? options.fn(this) : options.inverse(this);
        case "===":
            return (var1 === var2) ? options.fn(this) : options.inverse(this);
        case "!==":
            return (var1 !== var2) ? options.fn(this) : options.inverse(this);
        case "&&":
            return (var1 && var2) ? options.fn(this) : options.inverse(this);
        case "||":
            return (var1 || var2) ? options.fn(this) : options.inverse(this);
        case "<":
            return (var1 < var2) ? options.fn(this) : options.inverse(this);
        case "<=":
            return (var1 <= var2) ? options.fn(this) : options.inverse(this);
        case ">":
            return (var1 > var2) ? options.fn(this) : options.inverse(this);
        case ">=":
            return (var1 >= var2) ? options.fn(this) : options.inverse(this);
        default:
            if (!var1 || Handlebars.Utils.isEmpty(var1)) {
                return operator.inverse(this);
            } else {
                return operator.fn(this);
            }
    }
}