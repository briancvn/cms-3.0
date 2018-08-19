import { Directive, Input, OnChanges, OnDestroy, OnInit, SimpleChanges, TemplateRef, ViewContainerRef } from '@angular/core';
import { Subscription } from 'rxjs';

import { BasicSwitchValue, SwitchValue } from '../../Models/ContextSwitch/SwitchValue';

@Directive({
    selector: '[contextSwitch]',
})
export class ContextSwitchDirective implements OnInit, OnDestroy, OnChanges {
    @Input() contextSwitchContext: string;
    @Input() contextSwitch: BasicSwitchValue;
    @Input() contextSwitchIsDefault: boolean;
    @Input() contextSwitchVisible: BasicSwitchValue = true;

    private compareValueSubscription: Subscription;
    private lastCompareResult = false;

    // tslint:disable-next-line:no-any
    constructor(private switchValue: SwitchValue, private templateRef: TemplateRef<any>, private viewContainer: ViewContainerRef) { }

    public ngOnInit(): void {
        let defaultValue = null;
        if (this.contextSwitchIsDefault) {
            // in case there is no matching context found by findValueForContext, it will render the cases which have isDefault set;
            // this is achieved by passing the switch value of this directive as notfoundValue to findValueForContext
            defaultValue = this.contextSwitch;
        }

        const compareValueObservable = this.switchValue.findValueForContext(this.contextSwitchContext, defaultValue);
        if (compareValueObservable) {
            this.compareValueSubscription = compareValueObservable.subscribe({
                next: this.updateView.bind(this)
            });
        }
    }

    public ngOnChanges(changes: SimpleChanges): void {
        if (changes.contextSwitchVisible && !changes.contextSwitchVisible.firstChange) {
            this.updateView(this.contextSwitch);
        }
    }

    public ngOnDestroy(): void {
        if (this.compareValueSubscription) {
            this.compareValueSubscription.unsubscribe();
        }
    }

    private updateView(compareValue): void {
        // either the values directly match
        // or specifically as a workaround for some legacy issues we had/have, it's ensured
        // that when a boolean property for readonly (the compareValue from context) returns undefined, it's handled as false (i.e. not readonly).
        const compareResult = Boolean(this.contextSwitchVisible)
            && (this.contextSwitch === compareValue
                || (this.contextSwitch === false && !compareValue));

        if (compareResult && !this.lastCompareResult) {
            // If lastCompareResult was false and is new true, add template to DOM
            this.viewContainer.createEmbeddedView(this.templateRef);
        } else if (!compareResult && this.lastCompareResult) {
            // clear current view if compare result changed from true to false
            this.viewContainer.clear();
        }
        this.lastCompareResult = compareResult;
    }
}
