// tslint:disable:no-any
export class Utils {
    /**
    * Copies a string to the clipboard. Must be called from within an event handler such as click.
    * May return false if it failed, but this is not always
    * possible. Browser support for Chrome 43+, Firefox 42+, Edge and IE 10+.
    * No Safari support, as of (Nov. 2015). Returns false.
    * IE: The clipboard feature may be disabled by an adminstrator. By default a prompt is
    * shown the first time the clipboard is used (per session).
    */
   public static copyToClipboard(text: string): boolean {
        if ((<any>window).clipboardData && (<any>window).clipboardData.setData) {
            // IE specific code path to prevent textarea being shown while dialog is visible.
            return (<any>window).clipboardData.setData('Text', text);

        } else if (document.queryCommandSupported && document.queryCommandSupported('copy')) {
            var textarea = document.createElement('textarea');
            textarea.textContent = text;
            textarea.style.position = 'fixed';  // Prevent scrolling to bottom of page in MS Edge.
            document.body.appendChild(textarea);
            textarea.select();
            try {
                return document.execCommand('copy');  // Security exception may be thrown by some browsers.
            } catch (ex) {
                return false;
            } finally {
                document.body.removeChild(textarea);
            }
        }
    }
}