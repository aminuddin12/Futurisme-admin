import { Button, ButtonProps } from '@radix-ui/themes';
const ButtonThird = (props: ButtonProps) => (
    <Button variant="ghost" color="gray" {...props} />
);
ButtonThird.displayName = 'ButtonThird';
export default ButtonThird;
