import { Directive, ElementRef, OnInit } from '@angular/core';
import { fromEvent } from 'rxjs/internal/observable/fromEvent';

import { Subscribable } from '../Common/Subscribable';
import { Utils } from '../Utils';

@Directive({
    selector: '[copy-to-clipboard]',
    inputs: ['event:copy-to-clipboard']
})
export class CopyToClipboardDirective extends Subscribable implements OnInit {
    private event = 'dblclick';

    constructor(private elementRef: ElementRef) {
        super();
    }

    public ngOnInit(): void {
        this.subscribe(fromEvent(this.elementRef.nativeElement, this.event), () => {
            Utils.copyToClipboard(this.elementRef.nativeElement.textContent);
        });
    }
}
