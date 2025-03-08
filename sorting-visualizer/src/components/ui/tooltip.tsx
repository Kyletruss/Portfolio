import { Tooltip as ChakraTooltip, Portal } from "@chakra-ui/react";
import * as React from "react";

export interface TooltipProps {
  showArrow?: boolean;
  portalled?: boolean;
  portalRef?: React.RefObject<HTMLElement>;
  content: React.ReactNode;
  disabled?: boolean;
  children: React.ReactNode; // Explicitly add `children` here
}

export const Tooltip = React.forwardRef<HTMLDivElement, TooltipProps>(
  function Tooltip(props, ref) {
    const {
      showArrow,
      children,
      disabled,
      portalled = true,
      content,
      portalRef,
      ...rest
    } = props;

    if (disabled) return <>{children}</>; // Wrap children in a fragment if disabled

    return (
      <ChakraTooltip {...rest}>
        <ChakraTooltip.Trigger asChild>{children}</ChakraTooltip.Trigger>
        <Portal disabled={!portalled} container={portalRef}>
          <ChakraTooltip.Positioner>
            <ChakraTooltip.Content ref={ref}>
              {showArrow && (
                <ChakraTooltip.Arrow>
                  <ChakraTooltip.ArrowTip />
                </ChakraTooltip.Arrow>
              )}
              {content}
            </ChakraTooltip.Content>
          </ChakraTooltip.Positioner>
        </Portal>
      </ChakraTooltip>
    );
  }
);

