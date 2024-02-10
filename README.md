# FFfeather
Extension for Fat-free-framework with [feather-icons](https://feathericons.com/)

# Usage
Really easy:
````HTML
<feather type="activity">
````
Where "type" is icon name.
Don't forget setup css first (or icon would invisible):
````CSS
.feather {
  width: 24px;
  height: 24px;
  stroke: currentColor;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  fill: none;
}
````
as in [doc](https://github.com/feathericons/feather?tab=readme-ov-file#svg-sprite)

## Why use sprites?
Because it's the most resource-efficient method.
The browser caches just one single file and rarely makes subsequent requests. Less traffic, fewer requests, less time spent.

### Paid work
I [accept orders](https://www.upwork.com/workwith/codemake).

### [Donate](https://www.buymeacoffee.com/codemake)
