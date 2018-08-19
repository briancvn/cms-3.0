import { Observable, BehaviorSubject } from 'rxjs/Rx';

export type BasicSwitchValue = string | number | boolean;

export class SwitchValue {
    public value: Observable<BasicSwitchValue>;
    public context: string;

    constructor(private parent: SwitchValue) { }

    public findParentValueForContext(context?: string): Observable<BasicSwitchValue> {
        return this.findValueForContextStartFrom(context || this.parent.context, null, this.parent);
    }

    public findValueForContext(context: string, notFoundValue: BasicSwitchValue): Observable<BasicSwitchValue> {
        return this.findValueForContextStartFrom(context, notFoundValue, this);
    }

    private findValueForContextStartFrom(context: string, notFoundValue: BasicSwitchValue, startWith: SwitchValue): Observable<BasicSwitchValue> {
        let current: SwitchValue = startWith;
        while (current) {
            if (current.context === context) {
                return current.value;
            }
            current = current.parent;
        }
        return new BehaviorSubject(notFoundValue).asObservable();
    }
}
